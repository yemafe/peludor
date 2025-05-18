<?php
require_once __DIR__ . '/../../../vendor/autoload.php';
use Illuminate\Database\Capsule\Manager as Capsule;

//Eloquent conf
$capsule = new Capsule;
$capsule->addConnection([
    'driver'    => 'mysql',
    'host'      => '194.163.134.195', //http://db.eventiverse.es/
    'database'  => 'dev_peludors',
    'username'  => 'db_user_',
    'password'  => 'tjdbd@26-3*rQmo(',
    'charset'   => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix'    => '',
]);
$capsule->setAsGlobal();
$capsule->bootEloquent();

return $capsule;
