<?php
/**
 * @var $model \common\models\User
 * @var $this \yii\web\View
*@var $dataProvider \yii\data\ActiveDataProvider
*/

use yii\widgets\ListView;
use yii\widgets\Pjax;
use yii\helpers\Html;

?>

<div class="jumbotron p-4">
    <div class="row">
        <div class="col-1">
            <?= $model->profile->has_avatar 
                    ?  Html::img($model->profile->getAvatarLink(),['class' => 'avatar big-avatar'])
                    : ' <i class="fas fa-user-circle fa-5x"></i>' ?>
        </div>
        <div class="col-11">
            <div class="justify-content-between row container">
                <div class="ml-5" style="line-height: 0.9;">
                    <h4 class=""><?= $model->username ?></h4>
                    <small class="text-muted"><?= $model->getSubscribers()->count() ?> subscribers</small>
                </div>
                <div class="subscribe-btn">
                    <?php Pjax::begin() ?>
                        <?= $this->render('/partial/button/_subscribe_button', ['model' => $model])?>
                    <?php Pjax::end() ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php echo ListView::widget([
    'dataProvider' => $dataProvider,
    'itemView'  => '/partial/_video_item',
    'layout' => '<div class="d-flex flex-wrap">{items}</div>{pager}',
    'itemOptions' => [
        'tag' => false,
    ]
]) ?>



        