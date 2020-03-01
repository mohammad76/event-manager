Getting Started with Event Manager
=========================================
this is a documentation of Event Manager System. it's help you to work with Event Manager system. first you need to know what's this system start from Introduction


Introduction
------------------
this a Laravel Project for using this project you should have knowledge of laravel applications

Event Manager is a api base system , it's help you to build and manage your events and your guests

Installation
------------------
for install this project in your system you should install ``PHP`` , ``Mysql`` and ``Composer`` in your system.

first you should clone this project in your computer , use this command:

.. code-block:: PHP

    git clone https://github.com/mohammad76/event-manager.git

then you need go to the project folder:

.. code-block:: PHP

    cd event-manager

now you should install composer packages with this command:

.. code-block:: PHP

    composer install

in the next step you need to generate app key with this command:

.. code-block:: PHP

    php artisan key:generate

now we need jwt secret key you can build that with this command:

.. code-block:: PHP

    php artisan jwt:secret

ok, project is installed successfully but it's need a couple of steps to get ready.

Connect to Database
---------------------
Event Manager system work with mysql database and you should config that , here we have some help to config that

first you should build database in your mysql and put that in ``.env`` file in project directory, like this:

.. code-block:: PHP

    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=event-manager
    DB_USERNAME=root
    DB_PASSWORD=123

.. Note::
    * ``DB_PASSWORD`` can be null
    * ``DB_CONNECTION`` and ``DB_HOST`` and ``DB_PORT`` usually don't need to change

after that you need to migrate database and the default data , you can use this command:

.. code-block:: PHP

    php artisan migrate --seed

ok now Event Manager database is ready to use.

Make The Project Online
-------------------------
if you complete previous steps correctly project should be ready to get online with this command:

.. code-block:: PHP

    php artisan serv

you can see other sections of documentation to get more familiar with project.
