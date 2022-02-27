<?php 
/*@var $dataProvider \yii\data\ActiveDataProvider
@var $filterName string
*/

use yii\widgets\ListView;

?>
<h5 class="mb-3 m-3 font-weight-bold"><?= $filterName ?></h5>

<?php echo ListView::widget([
    'dataProvider' => $dataProvider,
    'itemView'  => '/partial/_video_item',
    'layout' => '<div class="d-flex flex-wrap">{items}</div>{pager}',
    'itemOptions' => [
        'tag' => false,
    ]
]) ?>