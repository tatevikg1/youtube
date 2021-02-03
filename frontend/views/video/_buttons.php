<?php 
/*@var $model \common\models\Video*/
use yii\helpers\Url;

?>

<a href="<?= Url::to(['video/like', 'id' => $model->video_id ])?>" 
    class="btn btn-sm <?= $model->isLikedBy(Yii::$app->user->id) ? 'btn-outline-primary' : 'btn-outline-secondary'?>"
    data-method="post" data-pjax="1">
    <i class="fas fa-thumbs-up">
        <?= $model->getLikes()->count() ?>
    </i>
</a>


<a href="<?= Url::to(['video/dislike', 'id' => $model->video_id ])?>" 
    class="btn btn-sm <?= $model->isDisikedBy(Yii::$app->user->id) ? 'btn-outline-primary' : 'btn-outline-secondary'?>"
    data-method="post" data-pjax="1">
    <i class="fas fa-thumbs-down">
        <?= $model->getDislikes()->count() ?>
    </i>
</a>
