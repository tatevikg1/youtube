<?php

use yii\helpers\Url;
use yii\widgets\Pjax;

Pjax::begin() ?>
    <a href="<?= Url::to(['/comment/get_reply_field', 'comment_id' => $model->id ])?>" 
        class="btn btn-sm"
        style="<?= $model->isDislikedBy(Yii::$app->user->id) ? 'color:blue' : 'color:grey'?>"
        data-method="post"
        data-pjax="1">
        Reply
    </a>
<?php Pjax::end() ?>