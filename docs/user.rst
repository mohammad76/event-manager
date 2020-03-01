User
=========================================
Users are base of our api system, because our system only work for logged user.

simply people should login or register to work with Event Manager system.


User Data
------------------
if you want see logged in user data you can use this route:

.. code-block:: PHP

    [GET] http://site.test/api/v1/user


Edit User
------------------
for updating user data you can use this route:

.. code-block:: PHP

    [POST] http://site.test/api/v1/user

update user route need some data you should pass to , this is data body

.. code-block:: JSON

    {
        "_method" : "PUT",
        "name" : "New Name",
        "password" : "123456789",
        "avatar" : "file",
    }

.. Note::
    * ``_method`` use for change request method, we can not upload avatar image thorough PUT method for this problem we should manipulation our system
    * for ``avatar`` field you should pass a image file

.. warning:: all fields are optionals and you can pass just what you want to update
