<?php
/**
 * @var $model \common\models\Video
 * 
*/

use yii\helpers\Url;

if ($model->isInWatchList()){
    $url = Url::to(['/video/later_remove', 'video_id' => $model->video_id ]);
    $style = "background-color:#b90000";
}else{
    $url = Url::to(['/video/later', 'video_id' => $model->video_id ]);
    $style = "color:white";
}
?>


<a data-toggle="tooltip" title="Watch later"
    href="<?= $url ?>" 
    role="button"
    data-method="post"
    data-pjax="1"
    >
    
    <button class="btn watch-later-button hide" style="<?= $style ?>"><i class="fas fa-clock "></i></button>
</a>
