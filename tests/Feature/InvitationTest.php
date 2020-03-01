<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class InvitationTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_see_received_invitations()
    {
        $user     = $this->createUser();
        $response = $this->apiAs($user, 'GET', route('api.received-invitations'));
        $response->assertStatus(200);
    }

    public function test_user_can_see_sended_invitations()
    {
        $user     = $this->createUser();
        $response = $this->apiAs($user, 'GET', route('api.sended-invitations'));
        $response->assertStatus(200);
    }

    public function test_user_can_send_invite_to_other_users_with_email()
    {
        $user  = $this->createUser();
        $event = $this->createEvent($user);

        $user2       = $this->createUser();
        $user3       = $this->createUser();
        $user4       = $this->createUser();
        $invitations = [ $user2->email, $user3->email, $user4->email ];
        $data        = [
            'invitations' => $invitations,
        ];
        $response    = $this->apiAs($user, 'POST', route('api.send-invitations', $event), $data);
        $response->assertStatus(200);
        $this->assertEquals($invitations, $response->json()['data']['invited']);
    }

    public function test_user_can_send_invite_to_other_users_with_mobile()
    {
        $user  = $this->createUser();
        $event = $this->createEvent($user);

        $user2       = $this->createUser();
        $user3       = $this->createUser();
        $user4       = $this->createUser();
        $invitations = [ $user2->mobile, $user3->mobile, $user4->mobile ];
        $data        = [
            'invitations' => $invitations,
        ];
        $response    = $this->apiAs($user, 'POST', route('api.send-invitations', $event), $data);
        $response->assertStatus(200);
        $this->assertEquals($invitations, $response->json()['data']['invited']);
    }

    public function test_user_can_send_invite_to_other_users_with_mobile_or_email()
    {
        $user  = $this->createUser();
        $event = $this->createEvent($user);

        $user2       = $this->createUser();
        $user3       = $this->createUser();
        $user4       = $this->createUser();
        $invitations = [ $user2->mobile, $user3->email, $user4->mobile ];
        $data        = [
            'invitations' => $invitations,
        ];
        $response    = $this->apiAs($user, 'POST', route('api.send-invitations', $event), $data);
        $response->assertStatus(200);
        $this->assertEquals($invitations, $response->json()['data']['invited']);
    }

    public function test_user_can_send_invite_to_not_exist_users()
    {
        $user        = $this->createUser();
        $event       = $this->createEvent($user);
        $invitations = [ '09303078340', 'aa@sadsd.com' ];
        $data        = [
            'invitations' => $invitations,
        ];
        $response    = $this->apiAs($user, 'POST', route('api.send-invitations', $event), $data);
        $response->assertStatus(200);
        $this->assertEquals($invitations, $response->json()['data']['not_exist']);
    }

    public function test_user_can_answer_invitation()
    {
        $user  = $this->createUser();
        $event = $this->createEvent($user);

        $user2               = $this->createUser();
        $invitations         = [ $user2->mobile ];
        $dataSendInvitations = [ 'invitations' => $invitations ];
        $this->apiAs($user, 'POST', route('api.send-invitations', $event), $dataSendInvitations);
        $responseReceivedInvitations = $this->apiAs($user2, 'GET', route('api.received-invitations'))->json();
        $invitation_id               = $responseReceivedInvitations['data'][0]['id'];

        $dataAnswerInvitation     = [ 'status' => 'accepted' ];
        $responseAnswerInvitation = $this->apiAs($user2, 'PATCH', route('api.answer-invitation', $invitation_id), $dataAnswerInvitation);
        $responseAnswerInvitation->assertStatus(200);
    }
}
