

### Prerequisite
- docker
- [PHP CLI](http://www.php-cli.com/)


### To start the project run the following commands in your terminal: 

1. ``docker compose up`` this will run a local environment.
2. ``docker ps -a`` and check that the port is correctly set in .env file.
3. ``php bin/console doctrine:migration:migrate`` it will create the database.
4. ``php bin/console doctrine:fixtures:load`` it will add some datas in our db.
