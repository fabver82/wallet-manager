# Wallet Manager

a simple app to log our expenses/incomes and to calculate the balance. 

### Prerequisite
- docker
- [PHP CLI](http://www.php-cli.com/)
- [symfony CLI](https://symfony.com/download)


### To start the project run the following commands in your terminal: 

1. ``npm install`` and ``composer install`` to install dependencies.
2. ``docker compose up`` this will run a local environment.
3. ``php bin/console doctrine:migration:migrate`` it will create the database.
4. if you got an error message : ``docker ps -a`` and check that the port is correctly set in .env file.
5. ``php bin/console doctrine:fixtures:load``, choose "yes" and it will add some fake datas in our db.
6. ``yarn build`` to compile js and css files.
7. ``symfony serve -d`` it will start the local server. Just click on the link to load the page.
8. user login example : user: user1 / PIN: 1111 

PHPMyAdmin is installed, you can check the database by going to localhost:8080.
user: root / password: password


### Some explanation about the code 
Because one of the only constraints was "one page". I try to use ajax request as much as possible. NodeJs would have been a better choice.

#### local server & docker
 I spend some time trying to setup a full environment with docker but it was easier with symfony for the local server, and docker only for the database. 
#### Symfony and Stimulus

symfony is used to create route and backend request. 
- Controllers are located in src/controllers
- models are called "entities", located in src/Entity
- Views are located in template ( twig files)
- we (try to) use Stimulus for the dynamic parts such as filling the movements table and sending post request. Those assets are located in src/assets/controllers. 
- Stimulus is really specific, basically the functions are called via data-'attribute' in their corresponding tag. Example: ``data-movements-target="filltable"`` link to ``filltableTargetConnected()`` in assets/controllers/movements_controller.js
- most functions has been refactored in assets/js/movement_utils.

Note: Stimulus is something that I discovered recently and that I don't master yet.

#### bootstrap and sass 
I have used bootstrap with sass, so it was easy to override some defaults paramater. However, I didn't spend a lot of time on the front.

#### login system 
Since we wanted a "one page", I try to use json_login to avoid refreshing the whole page. However, I didn't manage to find a solution to the bug I had ( error 401 when login with correct credentials, but "authenticate" after refreshing the page).
So I use the normal "form_login" system (from symfony)

More info: [symfony security doc](https://symfony.com/doc/current/security.html#form-login)

#### my own regret about this projects
- It was a bit messy: I should have used a trello board and spend some more time on the design 
- I didn't have a clear idea of what I wanted to do
- I spend too much time trying to fix the login system.





