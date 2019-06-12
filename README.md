# TestSymfony

### Prerequisites

* [php7](https://www.php.net/manual/fr/install.php)
* [composer](https://getcomposer.org/)
* [docker and docker-compose](https://docs.docker.com/compose/install/)

### Install the dependencies

 * `composer install`

### Settings

* `docker-compose up`
* `php bin/console make:migration`
* `php bin/console doctrine/migrations:migrate`

### Launch

* `docker-compose up`
* ` symfony server:start` **OR** `php bin/console server:run`


### Informations :

* `php bin/console about`
