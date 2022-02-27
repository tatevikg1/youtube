<?php

use yii\base\Controller;

class NotificationController extends Controller
{
    // ...
    
    public function behaviors()
    {
        return [
            // ...
            'authenticator' => [
                // define your authenticator behavior
                'class' => HttpBearerAuth::class,
            ]
        ];
    }
    
    public function actions()
    {
        return [
            'auth' => [
                'class' => 'le0m\broadcasting\actions\AuthAction'
            ]
        ];
    }
    
    // ...
}