<?php 
/*@var $model \common\models\Video
*/
use yii\widgets\ListView;

?>

<h5 class="mb-3">Search results</h5>
<?php echo ListView::widget([
    'dataProvider' => $dataProvider,
    'itemView'  => '/partial/_search_video',
    'layout' => '<div class="d-flex flex-wrap">{items}</div>{pager}',
    'itemOptions' => [
        'tag' => false,
    ]
]) ?>