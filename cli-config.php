<?php
use Doctrine\ORM\Tools\Console\ConsoleRunner;
use LaravelDoctrine\ORM\Facades\EntityManager;

// replace with file to your own project bootstrap
require_once 'bootstrap/autoload.php';
require_once 'bootstrap/app.php';

ini_set('display_errors', -1);
ini_set('error_reporting', -1);

EntityManager::flush();

//$app->make('Doctrine\ORM\EntityManagerInterface');
// replace with mechanism to retrieve EntityManager in your app
$entityManager = EntityManager::getFacadeRoot();

return ConsoleRunner::createHelperSet($entityManager);

