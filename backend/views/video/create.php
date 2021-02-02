<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Video */

$this->title = 'Create Video';
$this->params['breadcrumbs'][] = ['label' => 'Videos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="video-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="d-flex flex-column justify-content-center align-items-center">
        <div class="upload-icon justify-content-center">
            <i class="fas fa-upload"></i>
        </div>

        <br class="mt-4">

        <p class="m-0">Drag and drop video files to upload</p>
        <p class="text-muted">Your videos will be private until you publish them.</p>

        <?php \yii\bootstrap4\ActiveForm::begin([
            'options' => ['enctype' => 'multipart/form-data']
        ]) ?>

        <div class="btn btn-primary btn-file" id="selectVideoFile">
            Select file
            <input type="file" id="videoFile" name="video">
        </div>
        
        <?php \yii\bootstrap4\ActiveForm::end() ?>
    </div>

</div>
