<div style="box-shadow: 0 2px 4px 0 rgba(0, 0, 0, 0.1), 0 4px 8px 0 rgba(0, 0, 0, 0.1);">
<?php

use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;


    NavBar::begin([
        'brandLabel' => '<i class="fab fa-youtube fa-lg" style="color:red;"></i>'. Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
    ]);

    $menuItems = [  
        ['label' => '<i class="fas fa-video"></i> Create', 'url' => ['/video/create'],]
    ];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
    } else {
        $menuItems[] = [
            
            'label' => 'Logout('.Yii::$app->user->identity->username.')',
            'url' => ['/site/logout'],
            'linkOptions' => [
                'data-method' =>'post'
            ]
        ];   
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav ml-auto'],
        'items' => $menuItems,
    ]);
    NavBar::end();

?>
</div>
