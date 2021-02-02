<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Video */
/* @var $form yii\bootstrap4\ActiveForm */

\backend\assets\TagsInputAsset::register($this);
?>

<div class="video-form">

    <?php $form = ActiveForm::begin([
        'options' =>  ['enctype' => 'multipart/form-data']
    ]); ?>

    <div class="row">
        <div class="col-sm-8">

            <?php echo $form->errorSummary($model) ?>

            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

            <div class="form-group">
                <label> <?= $model->getAttributeLabel('thumbnail') ?> </label>
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="thumbnail" name="thumbnail">
                    <label class="custom-file-label" for="thumbnail">Choose file</label>
                </div>
            </div>

            <?= $form->field($model, 'tags', [
                'inputOptions' => ['data-role' => 'tagsinput'],
            ])->textInput(['maxlength' => true, 'class' => 'form-control']) ?>

            
        </div>
        <div class="col-sm-4">

            <div class="embed-responsive embed-responsive-16by9 mb-3">
                <video class="embed-responsive-item" 
                    src="<?= $model->getVideoLink() ?>" 
                    poster="<?= $model->getThumbnailLink() ?>" controls></video>
            </div>
            
            <div class="mb-3">
                <div class="text-muted">Video link</div>
                <a href="<?= $model->getVideoLink() ?>"> <?= substr($model->getVideoLink(), 0, 25) ?>... </a>
            </div>
            
            <div class="mb-3">
                <div class="text-muted">Video name </div>
                <?= $model->video_name ?>
            </div>
            <?= $form->field($model, 'status')->dropdownList($model->getStatusLabels()) ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
