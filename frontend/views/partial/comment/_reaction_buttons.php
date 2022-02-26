<?php

/** @var $model \common\models\Comment*/

use yii\helpers\Url;

?>
<div class="row">

    <form data-pjax="1" method="post" action="<?php echo Url::to(['/comment/like', 'id' => $model->id]) ?>" class="btn btn-sm" style="<?= $model->isLikedBy(Yii::$app->user->id) ? 'color:blue' : 'color:grey' ?>" data-method="post">

        <button type="submit" class="reactionbtn" style="<?= $model->isLikedBy(Yii::$app->user->id) ? 'color:blue' : 'color:grey' ?>">
            <i class="fas fa-thumbs-up">
                <?= $model->getLikes()->count() ?>
            </i>
        </button>

        <input type="hidden" name="id" value="<?= $model->id ?>">
    </form>

    <form data-pjax="1" method="post" action="<?php echo Url::to(['/comment/dislike', 'id' => $model->id]) ?>" class="btn btn-sm" style="<?= $model->isDislikedBy(Yii::$app->user->id) ? 'color:blue' : 'color:grey' ?>" data-method="post">

        <button type="submit" class="reactionbtn" style="<?= $model->isDislikedBy(Yii::$app->user->id) ? 'color:blue' : 'color:grey' ?>">
            <i class="fas fa-thumbs-down">
                <?= $model->getDislikes()->count() ?>
            </i>
        </button>

        <input type="hidden" name="id" value="<?= $model->id ?>">
    </form>

    <div class="btn btn-sm replybtn<?= $model->id ?>" style="color:grey" onclick="showReplyField(<?= $model->id ?>)">
        Reply
    </div>
    <div class="d-none replyField<?= $model->id ?>">
        <?= $this->renderAjax('/partial/comment/_reply', ['comment' => $model]); ?>
    </div>

</div>