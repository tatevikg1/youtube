<?php 
/*@var $likedProvider \common\models\Video
*@var $historyProvider \common\models\Video
*@var $watchLaterProvider \common\models\Video
*/
use yii\widgets\ListView;

?>


<h5 class="mb-3 m-3 font-weight-bold">Liked videos</h5>

<?php echo ListView::widget([
    'dataProvider' => $likedProvider,
    'itemView'  => '/partial/_video_item',
    'layout' => '<div class="d-flex flex-wrap">{items}</div>{pager}',
    'itemOptions' => [
        'tag' => false,
    ]
]) ?>


<h5 class="mb-3 m-3 font-weight-bold">History</h5>

<?php echo ListView::widget([
    'dataProvider' => $historyProvider,
    'itemView'  => '/partial/_video_item',
    'layout' => '<div class="d-flex flex-wrap">{items}</div>{pager}',
    'itemOptions' => [
        'tag' => false,
    ]
]) ?>


<h5 class="mb-3 m-3 font-weight-bold">History</h5>

<?php echo ListView::widget([
    'dataProvider' => $watchLaterProvider,
    'itemView'  => '/partial/_video_item',
    'layout' => '<div class="d-flex flex-wrap">{items}</div>{pager}',
    'itemOptions' => [
        'tag' => false,
    ]
]) ?>
