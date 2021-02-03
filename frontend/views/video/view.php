<?php /**
 * @var $model \common\models\Video
*/
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
                <?= $model->title ?>
            </div>
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <?= $model->getViews()->count() ?> views •
                    <?= Yii::$app->formatter->asDate($model->created_at) ?>
                </div>
                <div>
                    <?php Pjax::begin() ?>
                        <?= $this->render('_buttons', ['model' => $model])?>
                    <?php Pjax::end() ?>
                </div>
            </div>
        </div>
        <hr>
    </div>

    <div class="col-sm-4">
    </div>
</div>