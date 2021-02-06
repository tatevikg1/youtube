<?php 
/*@var $model \common\models\Video
*/
use \yii\helpers\Url;
?>
<div class="row align-items-center mb-1" style="width: 400px" 
    onmouseover="this.style.background='#dddddd';" 
    onmouseout="this.style.background='white';">

    <div class="col-5">
        <a href="<?php echo Url::to(['/video/view', 'id' => $model->video_id]) ?>">
            <div class="embed-responsive embed-responsive-16by9">
                <video class="p-1" 
                    src="<?= $model->getVideoLink() ?>" 
                    poster="<?= $model->getThumbnailLink() ?>" >
                </video>
            </div>
        </a>
    </div>

    <div class="col-7">
        <div class="p-2">
            <a href="<?php echo Url::to(['/video/view', 'id' => $model->video_id]) ?>" class="link-without-effects">
                <h6 class="font-weight-bold h6">  <?= $model->title ?> </h6>
            </a>
            <!-- <a href="<?php echo Url::to(['/channel/view', 'username' => $model->created_by]) ?>" class="link-without-effects"> -->
                <p class="text-muted h6"> <?= $model->createdBy->username ?>  </p>
            <!-- </a> -->
            <p class="text-muted m-0 h6"> 
                <?= $model->getViews()->count() ?> views • <?= Yii::$app->formatter->asRelativeTime($model->created_at) ?>
            </p>
        </div>
    </div>     
</div>