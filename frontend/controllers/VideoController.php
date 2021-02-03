<?php
namespace frontend\controllers;

// use Yii;
// use yii\base\InvalidArgumentException;
// use yii\web\BadRequestHttpException;

use yii\data\ActiveDataProvider;
use yii\web\Controller;
use common\models\Video;
use common\models\VideoView;
use Yii;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;

/**
 * Video controller
 */
class VideoController extends Controller
{
    /**
     * Displays videos.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Video::find()->published()->latest(),
        ]);
        return $this->render('index', [
            'dataProvider' => $dataProvider
        ]);
    }

    /**
     * Show the video.
     *
     * @return mixed
     */
    public function actionView($id)
    {
        $this->layout = 'front';
        $video =  Video::findOne($id);//->published()->andWhere('video_id', $id);

        if(!$video){
            throw new NotFoundHttpException('Video does not exists!');
        }else{
            $videoViews = new VideoView();
            $videoViews->updateViews($id, \Yii::$app->user->id);
        }

        return $this->render('view', [ 'model' => $video ]);
    }


}
