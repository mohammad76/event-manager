<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\EventListRequest;
use App\Http\Requests\EventStoreRequest;
use App\Http\Requests\EventUpdateRequest;
use App\Models\Event;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class EventController extends Controller
{
    use ApiResponse;

    public function index(EventListRequest $request)
    {
        $type = $request->type ?? 'all';
        return $this->successResponse($this->getEvents($type));
    }

    public function store(EventStoreRequest $request)
    {
        $data = auth()->user()->myEvents()->create($request->only('name', 'description'));
        return $this->successResponse($data, 201);
    }

    public function show(Event $event)
    {
        $this->authorize('view', $event);
        $event->load('members');
        return $this->successResponse($event);

    }

    public function showEventInvitations(Event $event)
    {
        $this->authorize('view', $event);
        $invitations = $event->invitations;
        $data        = [
            'event'       => $event,
            'invitations' => $invitations,
        ];
        return $this->successResponse($data);
    }

    public function update(EventUpdateRequest $request, Event $event)
    {
        $this->authorize('update', $event);
        $event->update($request->only('name', 'description'));
        return $this->successResponse($event, 200, 'Event updated successfully');
    }

    public function destroy(Event $event)
    {
        $this->authorize('delete', $event);
        $event->delete();
        return $this->successResponse('', 200, 'Event deleted successfully');
    }

    private function getEvents($type)
    {
        if ($type == 'creator') {
            return $this->getCreatedEvents();
        } elseif ($type == 'guest') {
            return $this->getInvitedEvents();
        }

        $myEvents      = $this->getCreatedEvents();
        $invitedEvents = $this->getInvitedEvents();
        return $myEvents->merge($invitedEvents);
    }

    private function getCreatedEvents()
    {
        return auth()->user()->myEvents()->with('members')->latest()->get();
    }

    private function getInvitedEvents()
    {
        return auth()->user()->invitedEvents()->with('members')->latest()->get();
    }
}
