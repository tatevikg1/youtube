<?php

/**
 * @var $model \common\models\User
 * 
 */

use yii\helpers\Url;

?>
<form method="post" data-pjax="1" action="<?= Url::to(['/channel/subscribe', 'username' => $model->username]) ?>">
    <input type="hidden" value="<?= $model->username ?>" name="username">
    <button type="submit" class="btn  <?= $model->isSubscribedBy(Yii::$app->user->id) ? "btn-secondary"  : "btn-danger" ?>" style="color:white">
        <?= $model->isSubscribedBy(Yii::$app->user->id) ? "Subscribed" :  "Subscribe" ?>
        <i class="far fa-bell"></i>
    </button>
</form>
