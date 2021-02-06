<?php 
/*@var $model \common\models\Video
*/
use \yii\helpers\Url;
use \yii\helpers\Html;
?>
<div class="row col-10 mt-3"
    onmouseover="this.style.background='#dddddd';" 
    onmouseout="this.style.background='white';">

    <div class="col-5">
        <a href="<?php echo Url::to(['/video/view', 'id' => $model->video_id]) ?>">
            <div class="embed-responsive embed-responsive-16by9">
                <video class="" 
                    src="<?= $model->getVideoLink() ?>" 
                    poster="<?= $model->getThumbnailLink() ?>" >
                </video>
            </div>
        </a>
    </div>

    <div class="col-7 p-2">
        <a href="<?php echo Url::to(['/video/view', 'id' => $model->video_id]) ?>" class="link-without-effects">

            <div class="card-body p-0 ">
                <h6 class="card-title m-0 p-0 h5 font-weight-bold" >
                    <?= $model->title ?>
                </h6>
                
                <p class="text-muted card-text h6"> 
                    <?= $model->getViews()->count() ?> views • <?= Yii::$app->formatter->asRelativeTime($model->created_at) ?>
                </p>

                <p class="text-muted card-text m-0 h6"> 
                    <?= $model->createdBy->profile->has_avatar 
                        ?  Html::img($model->createdBy->profile->getAvatarLink(),['class' => 'avatar small-avatar'])
                        : ' <i class="fas fa-user-circle fa-2x"></i>' ?>
                    <?= $model->createdBy->username ?>
                </p>

                <p class="text-muted mt-3 h6"><?= substr($model->description, 0, 140) ?></p>
            </div>
        </a>

    </div>     
</div>