<?php
/**
 * @var $model \common\models\Video
 * 
*/

use yii\helpers\Url;

?>


<a data-toggle="tooltip" title="Watch later"
    href="<?= Url::to(['/video/later', 'video_id' => $model->video_id ]) ?>" 
    role="button"
    data-method="post"
    data-pjax="1"
    style="color:white">
    
    <button class="btn watch-later-button hide"><i class="fas fa-clock "></i></button>
</a>
