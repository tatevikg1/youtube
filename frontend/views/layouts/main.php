<?php

/* @var $this \yii\web\View */
/* @var $content string */
use \frontend\assets\AppAsset;
use \common\widgets\Alert;

AppAsset::register($this);
// the begining of content
$this->beginContent('@frontend/views/layouts/base.php')
?>

    <div class="wrap h-100 d-flex flex-column">
        <?php echo $this->render('_header') ?>

        <main class="d-flex">
        
            <?php echo $this->render('_sidebar') ?>

            <div class="content p-3">
                <?= Alert::widget() ?>
                <?= $content ?>
            </div>

        </main>
    </div>

<?php 
// the end of content
$this->endContent() 
?>

