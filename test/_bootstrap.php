<?php
/**
 * Created by PhpStorm.
 * User: Vladya
 * Date: 29.07.2018
 * Time: 16:00
 */

defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../vendor/yiisoft/yii2/Yii.php';

Yii::setAlias('@tests', dirname(__DIR__) . '/tests');

//$config = require __DIR__ . '/../config/web.php';

$config = \yii\helpers\ArrayHelper::merge(
    require (__DIR__ . '/../config/web.php'),
    require (__DIR__ . '/config/config.php')
);

$application = new yii\web\Application($config);
//(new yii\web\Application($config))->run();