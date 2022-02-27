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
        'redis' => [
            'class' => 'yii\redis\Connection',
            'hostname' => 'localhost',
            'port' => 6379,
            'database' => 0,
        ],
        'broadcasting' => [
            'class' => 'le0m\broadcasting\BroadcastManager',
            'broadcaster' => [
                'class' => 'le0m\broadcasting\broadcasters\RedisBroadcaster',
                // use the redis connection component (default) or define a new one
                'redis' => 'redis',
                'channels' => [
                    // authorization callback for private and presence channels
                    'comments.{postId}' => function (yii\web\User $user, $postId) {
                        // use basic roles or RBAC
                        return $user->can('doSomething', ['post' => $postId]);
                    },
                ],
            ],
        ]  
    ],
];
