<?php
/**
 * @var $model \common\models\User
 * 
*/

use yii\helpers\Url;

?>


<a class="btn  <?= $model->isSubscribedBy(Yii::$app->user->id) ? "btn-secondary"  : "btn-danger"?>"
    href="<?= Url::to(['/channel/subscribe', 'username' => $model->username ]) ?>" 
    role="button"
    data-method="post"
    data-pjax="1"
    style="color:white">
        <?= $model->isSubscribedBy(Yii::$app->user->id) ? "Subscribed" :  "Subscribe" ?>
        <i class="far fa-bell"></i>
</a>


