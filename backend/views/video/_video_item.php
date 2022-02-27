<?php  
/**
 * @var $model \comon\models\video
 * */
/**  <img class="mr-3" src="<?= $model->getThumbnailLink()?>" alt="thumbnail" width="100px">
 */

use \yii\helpers\Url;
use \yii\helpers\StringHelper;
?>


<div class="media">
    <div class="embed-responsive embed-responsive-16by9 mr-2" style="width:120px">
        <a href="<?php echo Url::to(['/video/update', 'id' => $model->video_id]) ?>">
            <video class="embed-responsive-item" 
                src="<?= $model->getVideoLink() ?>" 
                poster="<?= $model->getThumbnailLink() ?>" >
            </video>
        </a>
    </div>
    
    <div class="media-body">
        <h6 class="mt-0" style="font-weight:bold"><?= $model->title ?></h6>
        <?= StringHelper::truncateWords($model->description, 10) ?>
    </div>
</div>