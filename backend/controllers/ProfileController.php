<?php

namespace backend\controllers;

use Yii;
use common\models\Video;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use \common\models\User;
use \common\models\Profile;
/**
 * VideoController implements the CRUD actions for Video model.
 */
class ProfileController extends Controller
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
                        'allow' => true,
                        'roles' => ['@'],
                    ]
                ]
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'update' => ['GET','POST'],
                ],
            ],
        ];
    }

    /**
     * Updates an existing Profile model.
     * If update is successful, the browser will be redirected to the '/' page.
     * @return mixed
     */
    public function actionUpdate()
    {
        $user =  User::find()->where(['id'=> Yii::$app->user->id])->one();
        $id = $user->profile->id;

        // find the profile of user
        $model = $this->findModel($id);

        $model['avatar'] = UploadedFile::getInstancesByName('avatar');
        // load() with second argument set to '' to  state that  POST fields are not including model name
        if($model->load(Yii::$app->request->post(), '') && $model->save()){
            return $this->redirect(['/']);
        }
        
        return $this->render('update', ['user' => $user]);   
    }

    /**
     * Deletes an existing Profile model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Profile model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Profile the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Profile::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
