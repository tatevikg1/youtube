<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
$this->beginContent('@backend/views/layouts/base.php'); 
?>

    <div class="wrap h-100 d-flex flex-column">
        <?php echo $this->render('_header') ?>

        <main class="d-flex align-self-center" style="max-width:400px;">
            <div class="content p-3">
                <?= Alert::widget() ?>
                <?= $content ?>
            </div>
        </main>    
    </div>

<?php $this->endContent() ?>

