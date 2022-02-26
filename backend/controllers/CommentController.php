<?php

namespace backend\controllers;

use common\models\Comment;
use Yii;
use yii\base\Controller;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;

class CommentController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ]
                ]
            ],
        ];
    }


    /**
     * Lists all Comments of the auth user.
     * @return mixed
     */
    public function actionIndex()
    {
        $comments = Comment::find()
            ->with('video', 'parent')
            ->andWhere(['created_by' => Yii::$app->user->id])
            ->latest()->all();

        if(!$comments){
            throw new NotFoundHttpException('You haven\'t commented yet!');
        }

        return $this->render('/comment/index', [ 'comments' => $comments, ]);
    }
}