<?php 
/*@var $model \common\models\Video
*/
use \yii\helpers\Url;
use \yii\helpers\Html;
use yii\widgets\Pjax;

?>

<div class="card m-3" style="width: 14rem;">

    <?php Pjax::begin() ?>
        <?= $this->render('/partial/button/_watch_later_button', ['model' => $model])?>
    <?php Pjax::end() ?>

    <div class="embed-responsive embed-responsive-16by9">
        <a href="<?php echo Url::to(['/video/view', 'id' => $model->video_id]) ?>">
            <video class="embed-responsive-item" 
                src="<?= $model->getVideoLink() ?>" 
                poster="<?= $model->getThumbnailLink() ?>" >
            </video>
        </a>
    </div>


    <div class="card-body p-2">
        <h6 class="card-title m-0" style="font-weight:bold">
            <?= $model->title ?>
        </h6>
        <p class="text-muted card-text m-0"> 
            <?= Html::a($model->createdBy->username, 
                ['channel/view', 'username' =>  $model->createdBy->username],
                ["class" => "channelname text-muted card-text m-0"])?>
        </p>
        <p class="text-muted card-text m-0" style="font-size: 11px;"> 
            <?= $model->getViews()->count() ?> views • <?= Yii::$app->formatter->asRelativeTime($model->created_at) ?>
        </p>
    </div>
</div>