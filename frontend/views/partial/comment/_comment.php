<?php /**
 * @var $comment \common\models\Comment
*/

use yii\helpers\Html;
// use \Yii;
use yii\widgets\Pjax;

?>

<div class="row mt-2">
    <div class="col-1">
        <?= $comment->createdBy->profile->has_avatar 
            ?  Html::img($comment->createdBy->profile->getAvatarLink(),['class' => 'avatar'])
            : ' <i class="fas fa-user-circle fa-3x"></i>' ?>
        
    </div>
    <div class="col-11">
        <div class="font-weight-bold">
            <?= $comment->createdBy->username ?>
            <small class="text-muted"><?= Yii::$app->formatter->asRelativeTime($comment->created_at) ?></small>
        </div>
        <div> <?= $comment->text ?></div>
        <div>
            <?php Pjax::begin() ?>
                <?= $this->render('/partial/comment/_reaction_buttons', ['model' => $comment])?>
            <?php Pjax::end() ?>
        </div>
    </div>
    
</div>
