<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Profile */
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

            <div class="form-group">
                <label> <?= $model->getAttributeLabel('avatar') ?> </label>
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="avatar" name="avatar">
                    <label class="custom-file-label" for="avatar">Choose file</label>
                </div>
            </div>
                        
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
