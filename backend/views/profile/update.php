<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Profile */

$this->title = 'Update Profile: ' . $user->username;
?>
<div class="video-update">

    <h1><?= Html::encode($user->username) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
