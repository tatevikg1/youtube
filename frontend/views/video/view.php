<?php /**
 * @var $model \common\models\Video
*/

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;

?>

<div class="row frontend-content">
    <div class="col-sm-8">

        <div class="embed-responsive embed-responsive-16by9 mr-2">

            <a href="<?php echo Url::to(['/video/update', 'id' => $model->video_id]) ?>">
                <video class="embed-responsive-item" 
                    src="<?= $model->getVideoLink() ?>" 
                    poster="<?= $model->getThumbnailLink() ?>" 
                    controls>
                </video>
                
            </a>
        </div>

        <div class="mt-2">
            <div style="font-weight: bold;">
                <?= Html::encode($model->title)  ?>
            </div>
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <?= $model->getViews()->count() ?> views •
                    <?= Yii::$app->formatter->asDate($model->created_at) ?>
                </div>
                <div>
                    <?php Pjax::begin() ?>
                        <?= $this->render('/partial/button/_reaction_buttons', ['model' => $model])?>
                    <?php Pjax::end() ?>
                </div>
            </div>
        </div>
        <hr>

        <div class="row">
            <div class="col-1">
                <?= $model->createdBy->profile->has_avatar 
                    ?  Html::img($model->createdBy->profile->getAvatarLink(),['class' => 'avatar'])
                    : ' <i class="fas fa-user-circle fa-3x"></i>' ?>
               
            </div>
            <div class="col-11">
                <div class="justify-content-between row container">
                    <div class="" style="line-height: 0.9;">
                        <div class="font-weight-bold ">
                            <?= Html::a($model->createdBy->username, 
                                ['channel/view', 'username' =>  $model->createdBy->username],
                                ["class" => "channelname"])?>
                        </div>
                        <small class="text-muted"><?= $model->createdBy->getSubscribers()->count() ?> subscribers</small>
                    </div>
                    <div class="subscribe-btn">
                        <?php Pjax::begin() ?>
                            <?= $this->render('/partial/button/_subscribe_button', ['model' => $model->createdBy])?>
                        <?php Pjax::end() ?>
                    </div>
                </div>
                <div class="mt-3">
                    <?= Html::encode($model->description)  ?>
                </div>
            </div>
        </div>
        <hr>

        <div>
            <div class="mt-2 mb-3 h5 font-weight-bold"><?= $model->getComments()->count() ?> comments</div>

            <?php if(!Yii::$app->user->isGuest): ?>
                <div class="row">
                    <div class="col-1"> 
                        <?= Yii::$app->user->identity->profile->has_avatar 
                            ?  Html::img(Yii::$app->user->identity->profile->getAvatarLink(),['class' => 'avatar'])
                            : ' <i class="fas fa-user-circle fa-3x"></i>'
                        ?>
                    </div>
                    <div class="col-11">
                        <?= $this->render('/partial/comment/_composer', ['video_id' => $model->video_id ]) ?>
                    </div>
                </div>
            <?php endif ?>
            
            <?= $this->render('/partial/comment/_comments', ['comments' => $comments]);?>
        </div>
    </div>

    <div class="col-sm-4">
        <?php foreach ($similarVideos  as $model)
            echo $this->render('/partial/_side_video', ['model' => $model]);
        ?>
    </div>
</div>