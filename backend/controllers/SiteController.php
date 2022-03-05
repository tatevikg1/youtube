<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use common\models\Comment;
use common\models\User;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $user = User::find()->where(['id' => Yii::$app->user->id])->one();
        $commentsCount = Comment::find()
            ->with('video', 'parent')
            ->andWhere(['created_by' => Yii::$app->user->id])
            ->count();

        $videosCount = $user->getVideos()->count();
        $subscribersCount = Yii::$app->cache->get('subscribers-'. $user->id);
        if(!$subscribersCount){
            $subscribersCount = $user->getSubscribers()->count();
            Yii::$app->cache->set('subscribers-'. $user->id, $subscribersCount);
        }
        $subscriptionsCount = Yii::$app->cache->get('subscriptions-'. $user->id);
        if(!$subscriptionsCount){
            $subscriptionsCount = $user->getSubscriptions()->count();
            Yii::$app->cache->set('subscriptions-'. $user->id, $subscriptionsCount);
        }

        return $this->render('index', [
            'videosCount' => $videosCount,
            'commentsCount' => $commentsCount,
            'subscribersCount' => $subscribersCount,
            'subscriptionsCount' => $subscriptionsCount
        ]);
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $this->layout = 'auth';

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            $model->password = '';

            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
