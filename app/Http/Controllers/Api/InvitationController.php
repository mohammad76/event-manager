<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AnswerInvitationRequest;
use App\Http\Requests\ReceivedInvitationsRequest;
use App\Http\Requests\SendedInvitationsRequest;
use App\Http\Requests\SendInvitationRequest;
use App\Models\Event;
use App\Models\EventMember;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class InvitationController extends Controller
{
    use ApiResponse;
    private $notExist = [];

    public function sendedInvitations(SendedInvitationsRequest $request)
    {
        $status            = $request->status ?? 'all';
        $sendedInvitations = auth()->user()->send_invitations();
        if ($status != 'all') {
            $response = $sendedInvitations->whereStatus($status)->get();
            return $this->successResponse($response);
        }
        $response = $sendedInvitations->get();
        return $this->successResponse($response);
    }

    public function answerInvitation(EventMember $invitation, AnswerInvitationRequest $request)
    {
        $this->authorize('answer', $invitation);
        if ($invitation->status != 'pending') {
            return $this->errorResponse('This Invitation Answer Before', '400');
        }

        $invitation->update($request->only('status'));
        return $this->successResponse($invitation, 200, 'Invitation Updated Successfully');
    }

    public function receivedInvitations(ReceivedInvitationsRequest $request)
    {
        $user                = auth()->user();
        $status              = $request->status ?? 'all';
        $receivedInvitations = $user->received_invitations();
        if ($status != 'all') {
            $response = $receivedInvitations->whereStatus($status)->get();
            return $this->successResponse($response);
        }
        $response = $receivedInvitations->get();
        return $this->successResponse($response);
    }

    public function sendInvitations(Event $event, SendInvitationRequest $request)
    {
        $this->authorize('send', [ EventMember::class, $event ]);
        $items          = $this->prepareInvitations($request);
        $data           = [];
        $invited        = [];
        $alreadyInvited = [];
        foreach ($items as $item => $id) {
            if (!$this->isAlreadyInvited($event, $id)) {
                array_push($invited, $item);
                array_push($data, $this->buildInvitationData($event, $id));
            } else {
                array_push($alreadyInvited, $item);
            }
        }
        auth()->user()->send_invitations()->insert($data);
        $response = [
            'invited'         => $invited,
            'already_invited' => $alreadyInvited,
            'not_exist'       => $this->notExist,

        ];
        return $this->successResponse($response);
    }

    private function buildInvitationData(Event $event, $invited_id)
    {
        return [
            'event_id'   => $event->id,
            'inviter_id' => auth()->user()->id,
            'invited_id' => $invited_id,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

    private function isAlreadyInvited($event, $userId)
    {
        $member  = $event->isInvited($userId);
        $creator = $event->isCreator($userId);
        return $member || $creator;
    }

    private function removeLoggedUserData($items)
    {
        $user   = auth()->user();
        $mobile = $user->mobile;
        $email  = $user->email;
        if (( $key = array_search($mobile, $items) ) !== FALSE || ( $key = array_search($email, $items) ) !== FALSE) {
            unset($items[$key]);
        }
        return $items;
    }

    private function prepareInvitations($request)
    {
        $items = array_unique($request->get('invitations'));
        $items = $this->removeLoggedUserData($items);
        $data  = [];
        foreach ($items as $item) {
            $id = \App\Models\User::whereEmail($item)->orWhere('mobile', $item)->pluck('id')->first();
            if ($id) {
                $data[$item] = $id;
            } else {
                array_push($this->notExist, $item);
            }
        }
        return array_unique($data);
    }
}
