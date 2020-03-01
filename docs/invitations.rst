Invitations
=========================================
for using Invitations Api first you should be logged in with a user for login you can see `Login Documentation <https://event-manager.readthedocs.io/en/latest/auth.html#login>`_


Send Invitation
------------------
for send invitation to other users you can use this route:

.. code-block:: PHP

    [POST] http://site.test/api/v1/{{event_id}}/send-invitations

.. Note:: instead of ``{{event_id}}`` you should put event id you want invite to.

Send Invitation need some data to invite other users , you can invite other users to gather, like this:

.. code-block:: JSON

    {
    "invitations": ["mohammad_m69@yahoo.com","09352864812" ,"ali@yahoo.com" , "09303030300" , "09332114546" , "09332131456" , "hasan@yahoo.com" , "sd@sadsad.com"]
    }

.. Note::
    * you only can invite other who is one of our users.
    * attention invitation to not one of our user ignored and we will show you these are in this api response.
    * you can invite other users by they ``email`` or ``mobile``
    * attention you only can invite other user who they aren't one of your event member or they aaren't rejected the last invitation.

.. warning:: the ``invitations`` field required and you should pass an array to that

Sended Invitations
--------------------
for see Sended Invitations before in Event Manager system you can use this route:

.. code-block:: PHP

    [GET] http://site.test/api/v1/sended-invitations?status=all

.. Note::
     * ``status`` parameter not required you can delete that, default ``status`` is ``all``
     * instead of ``all`` you can use ``accepted`` , ``rejected`` , ``pending`` or you can delete ``status`` parameter

Received Invitations
----------------------
for see Received Invitations from other users in Event Manager system you can use this route:

.. code-block:: PHP

    [GET] http://site.test/api/v1/received-invitations?status=all

.. Note::
     * ``status`` parameter not required you can delete that, default ``status`` is ``all``
     * instead of ``all`` you can use ``accepted`` , ``rejected`` , ``pending`` or you can delete ``status`` parameter

Answer an Invitation
----------------------
for answer a received invitation you can use this route:

.. code-block:: PHP

    [PATCH] http://site.test/api/v1/invitations/{{invitation_id}}

.. Note:: instead of ``{{invitation_id}}`` you should put invitation id you want answer to that.


 you should define data to answer an invitation , like this:

.. code-block:: JSON

    {
	"status": "accepted",
    }

.. Note:: you only can accept or reject an invitation, for that you can put ``accepted`` or ``rejected`` in ``status`` field.

.. warning:: the ``status`` field is required and you should put one of ``accepted`` or ``rejected`` value in there.
