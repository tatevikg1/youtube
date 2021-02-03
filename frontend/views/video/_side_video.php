<?php 
/*@var $model \common\models\Video
*/
use \yii\helpers\Url;
?>
<div class="row align-items-center" style="width: 400px">

    <div class="col-5">
        <a href="<?php echo Url::to(['/video/view', 'id' => $model->video_id]) ?>">
            <div class="embed-responsive embed-responsive-16by9">
                <video class="embed-responsive-item" 
                    src="<?= $model->getVideoLink() ?>" 
                    poster="<?= $model->getThumbnailLink() ?>" >
                </video>
            </div>
        </a>
    </div>

    <div class="col-7">
        <a href="<?php echo Url::to(['/video/view', 'id' => $model->video_id]) ?>">

            <div class="card-body p-2">
                <h6 class="card-title m-0 p-0" style="font-weight:bold">
                    <?= $model->title ?>
                </h6>
                <p class="text-muted card-text m-0"> 
                    <?= $model->createdBy->username ?>
                </p>
                <p class="text-muted card-text"> 
                    <?= $model->getViews()->count() ?> views • <?= Yii::$app->formatter->asRelativeTime($model->created_at) ?>
                </p>
            </div>
        </a>

    </div>    
</div>