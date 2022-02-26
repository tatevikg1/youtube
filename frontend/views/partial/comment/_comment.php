<?php

/**
 * @var $comment \common\models\Comment
 */

use yii\helpers\Html;
use yii\widgets\Pjax;

?>

<div class="row mt-2">
    <div class="col-1">
        <?= $comment->createdBy->profile->has_avatar
            ?  Html::img($comment->createdBy->profile->getAvatarLink(), ['class' => 'avatar'])
            : ' <i class="fas fa-user-circle fa-3x"></i>' ?>

    </div>
    <div class="col-11">
        <div class="font-weight-bold">
            <?= $comment->createdBy->username ?>
            <small class="text-muted"><?= Yii::$app->formatter->asRelativeTime($comment->created_at) ?></small>
        </div>
        <div> <?= $comment->text ?></div>
        <div>
            <?php Pjax::begin(['enablePushState' => false]) ?>
            <?= $this->render('/partial/comment/_reaction_buttons', ['model' => $comment]) ?>
            <?php Pjax::end() ?>

            <?php if ($comment->getComments()->count() > 0) : ?>
                <div class="btn btn-sm showbtn<?= $comment->id ?>" style="color:blue" onclick="showReplies(<?= $comment->id ?>)">
                    View <?= $comment->getComments()->count() ?> replies
                </div>
                <div class="d-none replies<?= $comment->id ?>">
                    <div class="btn btn-sm" style="color:blue" onclick="hideReplies(<?= $comment->id ?>)">
                        Hide <?= $comment->getComments()->count() ?> replies
                    </div>

                    <?= $this->render('/partial/comment/_comments', ['comments' => $comment->getComments()->all()]); ?>
                </div>
            <?php endif ?>
        </div>
    </div>
</div>