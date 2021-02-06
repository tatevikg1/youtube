<?php
namespace frontend\controllers;


use yii\data\ActiveDataProvider;
use yii\web\Controller;
use common\models\Video;
use yii\filters\AccessControl;

/**
 * Feed controller
 */
class FeedController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only'  => [ 'history', 'subscribtion'],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionHistory()
    {
        $query = Video::find()
            ->innerJoin("(SELECT video_id FROM  video_view WHERE user_id = :user_id) AS vv", 
                "vv.video_id = video.video_id", ['user_id' => \Yii::$app->user->id]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        return $this->render('history', [
            'filterName'  => 'History',
            'dataProvider' => $dataProvider
        ]);
    }

    /**4 videos with most views*/ 
    public function actionTranding()
    {
        $query = Video::find()
            ->alias('v')
            ->innerJoin("(SELECT COUNT(video_id),video_id FROM video_view  GROUP BY video_id ORDER BY COUNT(video_id) DESC LIMIT 4) AS vv",
                'vv.video_id = v.video_id');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        return $this->render('tranding', [
            'filterName' => 'Tranding videos',
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionSubscribtion()
    {
        $query = Video::find()
            ->alias('v')
            ->innerJoin("(SELECT channel_id FROM  subscriber WHERE user_id = :user_id) AS s", 
                "s.channel_id = v.created_by", ['user_id' => \Yii::$app->user->id])
            ->latest();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        return $this->render('filter', [
            'filterName' => 'Videos from subscribed channels',
            'dataProvider' => $dataProvider
        ]);
    }

    public function actionLiked()
    {
        $query = Video::find()
            ->alias('v')
            ->innerJoin("(SELECT video_id FROM  video_like WHERE user_id = :user_id AND type = 1) AS vl", 
                "vl.video_id = v.video_id", ['user_id' => \Yii::$app->user->id])
            ->latest();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        return $this->render('filter', [
            'filterName' => 'Liked videos',
            'dataProvider' => $dataProvider
        ]);
    }

    public function actionLibrary()
    {
        $liked = Video::find()
            ->alias('v')
            ->innerJoin("(SELECT video_id FROM  video_like WHERE user_id = :user_id AND type = 1) AS vl", 
                "vl.video_id = v.video_id", ['user_id' => \Yii::$app->user->id])
            ->latest();

        $history = Video::find()
            ->innerJoin("(SELECT video_id FROM  video_view WHERE user_id = :user_id) AS vv", 
                "vv.video_id = video.video_id", ['user_id' => \Yii::$app->user->id]);


        $likedProvider = new ActiveDataProvider(['query' => $liked,]);
        $historyProvider = new ActiveDataProvider(['query' => $history,]);

        return $this->render('library', [
            'likedProvider' => $likedProvider,
            'historyProvider' => $historyProvider
        ]);
    }

    public function actionLater()
    {
        $query = Video::find()
            ->alias('v')
            ->innerJoin("(SELECT video_id FROM  video_like WHERE user_id = :user_id AND type = 1) AS vl", 
                "vl.video_id = v.video_id", ['user_id' => \Yii::$app->user->id])
            ->latest();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        return $this->render('filter', [
            'fileterName' => 'Watch later',
            'dataProvider' => $dataProvider
        ]);
    }

}
