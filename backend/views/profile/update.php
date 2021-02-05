<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Profile */

$this->title = 'Update Profile: ' . $user->username;
?>
<div class="video-update">

    <h1><?= Html::encode($user->username) ?></h1>

    <form action="/profile/update" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label> Avatar </label>
            <div class="custom-file">
                <input type="hidden" name="<?= \Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->csrfToken; ?>" />
                <input type="file" class="custom-file-input" id="avatar" name="avatar">
                <label class="custom-file-label" for="avatar">Choose file</label>
            </div>
        </div>
        <input type="submit" class="btn btn-success">
    </form>

</div>
