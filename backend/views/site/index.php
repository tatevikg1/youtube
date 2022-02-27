<?php

/* @var $this yii\web\View */

$this->title = 'Studio dashboard';
?>
<div class="site-index">

    <div class="container">
        <div class="row font-italic">
            <div class="col">
                <div class="jumbotron d-flex justify-content-between">
                    <h1>Number of videos!</h1>
                    <div class="font-weight-bold h3">
                        <?= $videosCount ?>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="jumbotron d-flex justify-content-between">
                    <h1>Number of comments!</h1>
                    <div class="font-weight-bold h3">
                        <?= $commentsCount ?>
                    </div>
                </div>
            </div>
            <div class="w-100"></div>
            <div class="col">
                <div class="jumbotron d-flex justify-content-between">
                    <h1>Number of subscribers!</h1>
                    <div class="font-weight-bold h3">
                        <?= $subscribersCount ?>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="jumbotron d-flex justify-content-between">
                    <h1>Number of sunscribtions!</h1>
                    <div class="font-weight-bold h3">
                        <?= $subscriptionsCount ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>