<?php

namespace test;

use app\models\User;

require (__DIR__ . '/_bootstrap.php');

//echo Yii::$app->name . PHP_EOL;

$user = new User();

$user->username = 'Vlad';
$user->email = 'mail$vlad.ru';

print_r($user->getAttributes());