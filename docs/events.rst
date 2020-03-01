Events
=========================================
for using Events Api first you should be logged in with a user for login you can see `Login Documentation <https://event-manager.readthedocs.io/en/latest/auth.html#login>`_

Create Event
------------------
for creating Event you can use this route:

.. code-block:: PHP

    [POST] http://site.test/api/v1/events

for creating you should pass these arguments to the route

.. code-block:: JSON

    {
	"name": "my birthday",
	"description": "this is my 24 birthday"
    }

.. Note:: ``name`` and ``description`` both required and if you don't pass api give you a validation error

Update Event
------------------
for update an Event you can use this route:

.. code-block:: PHP

    [PUT] http://site.test/api/v1/events/{{event_id}}

.. Note:: instead of ``{{event_id}}`` you should put event id you want to edit

.. warning:: just know you only can update own events and if you want to request for update other events api get a 403 error


as you know for update an event you should pass some data to the api this is what you should pass that

.. code-block:: JSON

    {
	"name": "New Name",
	"description": "New Description"
    }

.. Note:: ``name`` and ``description`` not required and you can pass just one of them

Delete Event
------------------
if you want delete a event you can use this route

.. code-block:: PHP

    [DELETE] http://site.test/api/v1/events/{{event_id}}

.. Note:: instead of ``{{event_id}}`` you should put event id you want to delete

.. warning:: just know you only can delete own events and if you want to request for delete other events api get a 403 error

Events List
------------------
for viewing events list you can use this route:

.. code-block:: PHP

    [GET] http://site.test/api/v1/events?type=all

.. Note::
     * you only see events if you are creator of that or you are a guest of that events
     * ``type`` parameter not required you can delete that, default ``type`` is ``all``
     * instead of ``all`` you can use ``creator`` and ``guest`` or you can delete type parameter


Show Event
------------------
for viewing a single event you can use this route:

.. code-block:: PHP

    [GET] http://site.test/api/v1/events/{{event_id}}

.. Note:: instead of ``{{event_id}}`` you should put event id you want to see

Show Event Invitations
----------------------
if you want to see invitations related to a event you should use this route:

.. code-block:: PHP

    [GET] http://site.test/api/v1/events/{{event_id}}/invitations

.. Note:: instead of ``{{event_id}}`` you should put event id you want to see
