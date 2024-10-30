## Configuración

## Requisitos del Sistema

PHP 8.3 con el driver PDO de MySQL
MySQL 8
PHPUnit
Docker (opcional)

## Configuración de la Base de Datos

## Para Docker

Los datos de la base de datos se deben configurar en el archivo .env. Asegúrate de proporcionar la información correcta para la conexión a la base de datos.

## Para entorno LAMP

Si estás utilizando un entorno LAMP tradicional, asegúrate de tener instalado PHP 8.3 con el driver PDO de MySQL y MySQL 8. Configura la conexión a la base de datos en el archivo .env.

## Levantar el Entorno con Docker Compose

Si optas por utilizar Docker Compose, ejecuta el siguiente comando en la raíz del proyecto para levantar los contenedores de PHP y MySQL:

docker-compose up -d

## Ejecutar Migraciones

## Para Docker

Una vez que los contenedores estén en funcionamiento, ejecuta el archivo migrate.php para crear la base de datos, las tablas y ejecutar los seeders:

docker-compose exec app php migrate.php

## Para entorno LAMP

En un entorno LAMP tradicional, ejecuta el siguiente comando para ejecutar las migraciones:

php migrate.php

## Ejecutar Pruebas Unitarias

## Para Docker

Para ejecutar las pruebas unitarias con PHPUnit en Docker, utiliza el siguiente comando:

docker-compose exec app php ./vendor/bin/phpunit test

## Para entorno LAMP

En un entorno LAMP tradicional, ejecuta las pruebas unitarias con el siguiente comando:

php ./vendor/bin/phpunit test

## Ejecutar la Aplicación

## Para Docker

Para ejecutar la aplicación en Docker, utiliza el siguiente comando:

docker-compose exec app php index.php

## Para entorno LAMP

En un entorno LAMP tradicional, ejecuta la aplicación con el siguiente comando:

php index.php