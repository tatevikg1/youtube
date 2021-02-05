<?php
use yii\helpers\Html;
use yii\helpers\Url;
/* @var $channel common\models\User */
/* @var $subscriber common\models\User */

?>
<div class="verify-email">
    <p>Hello <?= Html::encode($channel->username) ?>,</p>

    <p>User 
        <?= Html::a($subscriber->username, Url::to(['/channel/view', 'username' => $subscriber->username], true), ['class' => 'text-dark']) ?> 
        has subscribed to your channel.
    </p>

    <p><?= Yii::$app->name ?> team :)</p>
</div>
