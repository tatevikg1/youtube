<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'pusher' => [
            'class'     => 'br0sk\pusher\Pusher',
            //Mandatory parameters
            'appId'     => 'YOUR_APP_ID',
            'appKey'    => 'YOUR_APP_KEY',
            'appsecret' => 'YOUR_APP_SECRET',
            //Optional parameter
            'options'   => ['encrypted' => true]
        ],    
    ],
];
