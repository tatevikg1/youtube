<?php

namespace frontend\controllers;

use common\models\Comment;
use common\models\CommentLike;
use \Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;

class CommentController extends \yii\web\Controller
{
    public function behaviors()
    {
        return [

            'access' => [
                'class' => AccessControl::class,
                'only'  => ['create'],
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
                    'create' => ['post'],
                    'like' => ['post'],
                    'dislike' => ['post'],
                ]
            ]
        ];
    }

    public function actionCreate()
    {
        $video_id = Yii::$app->request->post('video_id');

        $comment  = new Comment();
        $comment->created_by = Yii::$app->user->id;
        $comment->video_id = $video_id;
        $comment->text = Yii::$app->request->post('text');
        $comment->created_at = time();
        $comment->save();


        return $this->renderAjax('/partial/_comment_composer', [
            'video_id' => $video_id,
        ]);
    }

    public function actionLike($id)
    {
        $comment = $this->findComment($id);
        $user_id = Yii::$app->user->id;

        $commentReaction = CommentLike::find()->userReacted($user_id, $comment->id)->one();

        if(!$commentReaction){
            $commentReaction = new CommentLike();
            $this->saveReaction($id, $user_id, CommentLike::TYPE_LIKE);

        }else if($commentReaction->type == CommentLike::TYPE_LIKE){
            $commentReaction->delete();
        }else{
            $commentReaction->delete();
            $this->saveReaction($id, $user_id, CommentLike::TYPE_LIKE);
        }

        return $this->renderAjax('/partial/button/_comment_reaction_buttons', ['model' => $comment]);
    }

    public function actionDislike($id)
    {
        $comment = $this->findComment($id);
        $user_id = Yii::$app->user->id;

        $commentReaction = CommentLike::find()->userReacted($user_id, $comment->id)->one();

        if(!$commentReaction){
            $commentReaction = new CommentLike();
            $this->saveReaction($id, $user_id, CommentLike::TYPE_DISLIKE);

        }else if($commentReaction->type == CommentLike::TYPE_DISLIKE){
            $commentReaction->delete();
        }else{
            $commentReaction->delete();
            $this->saveReaction($id, $user_id, CommentLike::TYPE_DISLIKE);
        }

        return $this->renderAjax('/partial/button/_comment_reaction_buttons', ['model' => $comment]);
    }

    public function findComment($id)
    {
        $comment = Comment::findOne($id);
        if(!$comment){
            throw new NotFoundHttpException('Comment does not exists!');
        }
        return $comment;
    }

    protected function saveReaction($comment_id, $user_id, $type)
    {
        $commentReaction = new CommentLike();
        $commentReaction->comment_id = $comment_id;
        $commentReaction->user_id = $user_id;
        $commentReaction->type = $type;
        $commentReaction->created_at = time();
        $commentReaction->save();
    }
}
