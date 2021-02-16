<?php 
/** @var $model \common\models\Comment*/

use yii\helpers\Url;

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

    <?= $this->render('/partial/comment/_reply_button', ['model' => $model])?>
</div>

