<?php
use Doctrine\ORM\Tools\Console\ConsoleRunner;
use LaravelDoctrine\ORM\DoctrineServiceProvider;

/** @var Application $app */
$app = require_once __DIR__.'/bootstrap/app.php';

/** @var Illuminate\Contracts\Http\Kernel $kernel */
$kernel = $app->make('Illuminate\Contracts\Console\Kernel');
$kernel->bootstrap();

$app->boot();

$entityManager = $app->make('Doctrine\ORM\EntityManager');

return ConsoleRunner::createHelperSet($entityManager); 
