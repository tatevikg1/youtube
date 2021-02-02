<?php
namespace frontend\controllers;

// use Yii;
// use yii\base\InvalidArgumentException;
// use yii\web\BadRequestHttpException;

use yii\data\ActiveDataProvider;
use yii\web\Controller;
use common\models\Video;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * Video controller
 */
class VideoController extends Controller
{
    // /**
    //  * {@inheritdoc}
    //  */
    // public function behaviors()
    // {
    //     return [
    //         'access' => [
    //             'class' => AccessControl::className(),
    //             'only' => ['logout', 'signup'],
    //             'rules' => [
    //                 [
    //                     'actions' => ['signup'],
    //                     'allow' => true,
    //                     'roles' => ['?'],
    //                 ],
    //                 [
    //                     'actions' => ['logout'],
    //                     'allow' => true,
    //                     'roles' => ['@'],
    //                 ],
    //             ],
    //         ],
    //         'verbs' => [
    //             'class' => VerbFilter::className(),
    //             'actions' => [
    //                 'logout' => ['post'],
    //             ],
    //         ],
    //     ];
    // }

    // /**
    //  * {@inheritdoc}
    //  */
    // public function actions()
    // {
    //     return [
    //         'error' => [
    //             'class' => 'yii\web\ErrorAction',
    //         ],
    //         'captcha' => [
    //             'class' => 'yii\captcha\CaptchaAction',
    //             'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
    //         ],
    //     ];
    // }

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


}
