<?php 
/** @var $model \common\models\Comment*/

use yii\helpers\Url;
use yii\widgets\Pjax;

?>
<div class="row">
    <a href="<?= Url::to(['/comment/like', 'id' => $model->id ])?>" 
        class="btn btn-sm"
        style="<?= $model->isLikedBy(Yii::$app->user->id) ? 'color:blue' : 'color:grey'?>"
        data-method="post" data-pjax="1">
        <i class="fas fa-thumbs-up">
            <?= $model->getLikes()->count() ?>
        </i>
    </a>

    <a href="<?= Url::to(['/comment/dislike', 'id' => $model->id ])?>" 
        class="btn btn-sm"
        style="<?= $model->isDislikedBy(Yii::$app->user->id) ? 'color:blue' : 'color:grey'?>"
        data-method="post" data-pjax="1">
        <i class="fas fa-thumbs-down">
            <?= $model->getDislikes()->count() ?>
        </i>
    </a>

    <?php Pjax::begin() ?>
        <a href="<?= Url::to(['/comment/get_reply_field', 'comment_id' => $model->id ])?>" 
            class="btn btn-sm"
            style="<?= $model->isDislikedBy(Yii::$app->user->id) ? 'color:blue' : 'color:grey'?>"
            data-method="post"
            data-pjax="1">
            Reply
        </a>
    <?php Pjax::end() ?>
</div>

