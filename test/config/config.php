<?php
/**
 * Created by PhpStorm.
 * User: Vladya
 * Date: 29.07.2018
 * Time: 16:00
 */
return [
    'language' => 'en-US',
    'components' => [
        'db' => [
            'dsn' => 'sqlite' . __DIR__ . '/../../data/test.db',
        ],
        'mailer' => [
            'useFileTransport' => true,
        ],
        'urlManager' => [
            'showScriptName' => true,
        ],
    ],
];