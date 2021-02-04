<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Videos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="video-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'title',
                'content' => function($model){
                    return $this->render('_video_item', ['model' => $model]);
                }
            ],

            [
                'attribute' => 'status',
                'content' => function($model){
                    return $model->getStatusLabels()[$model->status];
                }
            ],

            'created_at:datetime',
            'updated_at:datetime',

            [
                'class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'delete' => function($url){
                        return Html::a( '<i class="fas fa-trash-alt"></i>', $url, [
                            'data-method' => 'post',
                            'data-confirm'=> 'Are you sure?'
                        ]);
                    }
                ]
            ],
        ],
    ]); ?>


</div>
