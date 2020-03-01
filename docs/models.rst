Work With Models
=========================================
we build some method for you to make your job easy , lets go to see these

User
----------
First of all our models in ``app/Models`` directory, it's better for develop.

get events who I created:

.. code-block:: PHP

   $user->myEvents();

get events who I invited:

.. code-block:: PHP

   $user->invitedEvents();

get invitations who get from other users:

.. code-block:: PHP

   $user->received_invitations();

get invitations you sended to other users:

.. code-block:: PHP

   $user->send_invitations();

Events
----------
get if giving user created this event

.. code-block:: PHP

   $event->isCreator($user);

get if giving user invited to this event

.. code-block:: PHP

   $event->isInvited($user);

get if giving user member of this event

.. code-block:: PHP

   $event->isMember($user);

get event sended invitations

.. code-block:: PHP

   $event->invitations();

get event members (they are accepted a invitation)

.. code-block:: PHP

   $event->members();

Invitation
------------
get invitation related event

.. code-block:: PHP

   $event->event();

get invitation invitor user

.. code-block:: PHP

   $event->invitor();

get invitation invited user

.. code-block:: PHP

   $event->invited();
