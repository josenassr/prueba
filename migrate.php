<?php

require __DIR__ . '/vendor/autoload.php';

use Database\Migrations\CreateDatabase;
use Database\Migrations\CreateHotelesTable;
use Database\Migrations\CreateApartamentosTable;
use Database\Seeders\DatabaseSeeder;

$databaseMigration = new CreateDatabase();
$databaseMigration->down();
$databaseMigration->up();

$hotelesMigration = new CreateHotelesTable();
$hotelesMigration->down();
$hotelesMigration->up();

$apartamentosMigration = new CreateApartamentosTable();
$apartamentosMigration->down();
$apartamentosMigration->up();

$seeder = new DatabaseSeeder();
$seeder->run();
?>