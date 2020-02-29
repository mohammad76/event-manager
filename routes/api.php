<?php

Route::middleware('jwt.verify')->group(function () {
    Route::get('/user', 'Api\UserController@loggedUser');
    Route::put('/user', 'Api\UserController@update');
    Route::apiResource('events', 'Api\EventController');
    Route::get('events/{event}/invitations', 'Api\EventController@showEventInvitations')->name('events.show.invitations');
    Route::get('received-invitations', 'Api\InvitationController@receivedInvitations');
    Route::get('sended-invitations', 'Api\InvitationController@sendedInvitations');
    Route::post('{event}/send-invitations', 'Api\InvitationController@sendInvitations');
    Route::patch('invitations/{invitation}', 'Api\InvitationController@answerInvitation');
});
Route::post('/register', 'Api\AuthController@register')->name('api.user.register');
Route::post('/login', 'Api\AuthController@login');
