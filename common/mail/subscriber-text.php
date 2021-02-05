<?php
/* @var $channel common\models\User */
/* @var $subscriber common\models\User */

?>

Hello <?= $channel->username ?>,

User <?= $subscriber->username ?> has subscribed to your channel.

<?= Yii::$app->name ?> team.
