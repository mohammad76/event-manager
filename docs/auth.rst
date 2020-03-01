Authentication
=========================================
Authentication is a first step to use Event Manager Api , if you want to use any section of this system you should first register or login to the system.
Event Manager system use ``JWT`` as Authentication Method , we Believe it's a better way to Authenticate Users of our system.


Register
------------------
for register in Event Manager system you can use this route:

.. code-block:: PHP

    [POST] http://site.test/api/v1/register

as you know you should pass some data to this route, this is what you should pass to the route.

.. code-block:: JSON

    {
        "name" : "mohammad aliabadi",
        "mobile" : "09303030300",
        "email" : "mohammad@mail.com",
        "password" : "123456789"
    }

.. Note:: all data are required and you should pass them.

.. warning:: in data you pass unique ``mobile`` , ``email`` and minimum length of password is 6 character.

Login
------------------
for login to the Event Manager system you should have registered before, after registering to the system you can login.
for login you can use this route:

.. code-block:: PHP

    [POST] http://site.test/api/v1/login

of course for login to the system you should have ``username`` and ``password``.

``username`` field can be a ``email`` or ``mobile`` it depends on you with what you want to login , at the end it doesn't different what you choose.

.. code-block:: JSON

    {
        "username" : "09303030300",
        "password" : "123456789"
    }

.. Note:: all data are required and you should pass them.
.. warning:: in ``username`` you should pass a valid email address or mobile number.
