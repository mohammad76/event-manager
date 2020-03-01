<?php

Route::middleware('jwt.verify')->group(function () {
    Route::get('/user', 'UserController@loggedUser')->name('api.user.me');
    Route::put('/user', 'UserController@update')->name('api.user.update');
    Route::apiResource('events', 'EventController', [ 'as' => 'api' ]);
    Route::get('events/{event}/invitations', 'EventController@showEventInvitations')->name('api.events.show.invitations');
    Route::get('received-invitations', 'InvitationController@receivedInvitations')->name('api.received-invitations');
    Route::get('sended-invitations', 'InvitationController@sendedInvitations')->name('api.sended-invitations');
    Route::post('{event}/send-invitations', 'InvitationController@sendInvitations')->name('api.send-invitations');
    Route::patch('invitations/{invitation}', 'InvitationController@answerInvitation')->name('api.answer-invitation');
});
Route::post('/register', 'AuthController@register')->name('api.user.register');
Route::post('/login', 'AuthController@login')->name('api.user.login');
