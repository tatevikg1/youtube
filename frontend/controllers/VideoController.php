<?php
namespace frontend\controllers;


use yii\data\ActiveDataProvider;
use yii\web\Controller;
use common\models\Video;
use common\models\VideoLike;
use common\models\VideoView;
use common\models\WatchLater;
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
                'only'  => ['like', 'dislike', 'history'],
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
                    'later' =>['post'],
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
            'query' => Video::find()->with('createdBy')->published()->latest(),
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

        $similarVideos = Video::find()
            ->with('createdBy')
            ->published()
            ->andWhere(['NOT', ['video_id' => $id]])
            ->byKeyword($video->title)
            ->limit(10)->all();
    
        return $this->render('view', [ 'model' => $video , 'similarVideos' => $similarVideos]);
    }

    public function actionSearch($keyword)
    {
        $query = Video::find()->with('createdBy')->published()->latest();

        if($keyword){
           $query->byKeyword($keyword);
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        return $this->render('search', ['dataProvider' => $dataProvider]);
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

        return $this->renderAjax('/partial/button/_reaction_buttons', ['model' => $video]);
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

        return $this->renderAjax('/partial/button/_reaction_buttons', ['model' => $video]);
    }

    public function actionLater($video_id)
    {
        $video = $this->findVideo($video_id);
        $user_id = Yii::$app->user->id;

        $watchLater = WatchLater::find()
            ->andWhere(['user_id'=> $user_id, 'video_id' => $video_id])
            ->one();

        if(!$watchLater){
            $watchLater = new WatchLater();
            $watchLater->user_id = $user_id;
            $watchLater->video_id = $video_id;
            $watchLater->created_at = time();
            $watchLater->save(false);
        }        
        return $this->renderAjax('/partial/button/_watch_later_button', ['model' => $video]);
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
