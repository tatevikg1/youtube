<?php
namespace frontend\controllers;


use yii\data\ActiveDataProvider;
use yii\web\Controller;
use common\models\Video;
use common\models\VideoLike;
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
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only'  => ['like', 'dislike'],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verb'  => [
                'class' => VerbFilter::class,
                'actions' => [
                    'like' => ['post'],
                    'dislike' => ['post'],
                ]
            ]
        ];
    }
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
        $video = $this->findVideo($id);

        $videoViews = new VideoView();
        $videoViews->updateViews($id, \Yii::$app->user->id);

        $dataProvider = new ActiveDataProvider([
            'query' => Video::find()->published()->latest(),
        ]);
    
        return $this->render('view', [ 'model' => $video , 'dataProvider' => $dataProvider]);
    }

    public function actionLike($id)
    {
        $video = $this->findVideo($id);
        $user_id = Yii::$app->user->id;

        $videoReaction = VideoLike::find()->userReacted($user_id, $video->video_id)->one();

        if(!$videoReaction){
            $videoReaction = new VideoLike();
            $this->saveReaction($id, $user_id, VideoLike::TYPE_LIKE);

        }else if($videoReaction->type == VideoLike::TYPE_LIKE){
            $videoReaction->delete();
        }else{
            $videoReaction->delete();
            $this->saveReaction($id, $user_id, VideoLike::TYPE_LIKE);
        }

        return $this->renderAjax('/partial/_reaction_buttons', ['model' => $video]);
    }

    public function actionDislike($id)
    {
        $video = $this->findVideo($id);
        $user_id = Yii::$app->user->id;

        $videoReaction = VideoLike::find()->userReacted($user_id, $video->video_id)->one();

        if(!$videoReaction){
            $videoReaction = new VideoLike();
            $this->saveReaction($id, $user_id, VideoLike::TYPE_DISLIKE);

        }else if($videoReaction->type == VideoLike::TYPE_DISLIKE){
            $videoReaction->delete();
        }else{
            $videoReaction->delete();
            $this->saveReaction($id, $user_id, VideoLike::TYPE_DISLIKE);
        }

        return $this->renderAjax('/partial/_reaction_buttons', ['model' => $video]);
    }

    protected function findVideo($id)
    {
        $video = Video::findOne($id);
        if(!$video){
            throw new NotFoundHttpException('Video does not exists!');
        }
        return $video;
    }

    protected function saveReaction($video_id, $user_id, $type)
    {
        $videoReaction = new VideoLike();
        $videoReaction->video_id = $video_id;
        $videoReaction->user_id = $user_id;
        $videoReaction->type = $type;
        $videoReaction->created_at = time();
        $videoReaction->save();
    }


}
