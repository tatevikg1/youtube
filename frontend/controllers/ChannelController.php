<?php

namespace frontend\controllers;

use common\models\Subscriber;
use common\models\User;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use yii\data\ActiveDataProvider;
use common\models\Video;
use yii\filters\VerbFilter;

/** 
* class ChannelController
* @package frontend/controllers
*/
class ChannelController extends Controller
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only'  => ['subscribe'],
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
                    'subscribe' => ['post'],
                ]
            ]
        ];
    }


    public function actionView($username)
    {
        $channel = $this->findChannel($username);

        $dataProvider = new ActiveDataProvider([
            'query' => Video::find()->andWhere(['created_by'=> $channel->id])->published(),
        ]);

        return $this->render('view', ['model' => $channel, 'dataProvider' => $dataProvider]);
    }

    public function actionSubscribe($username)
    {
        $channel = $this->findChannel($username);
        $user_id = \Yii::$app->user->id;

        $subscriber = $channel->isSubscribedBy($user_id);

        if(!$subscriber){
            $subscriber = new Subscriber();
            $subscriber->user_id = $user_id;
            $subscriber->channel_id = $channel->id;
            $subscriber->created_at = time();
            $subscriber->save();

            // send an email to the channel to notify
            \Yii::$app->mailer->compose([
                'html' => 'subscriber-html',
                'text' => 'subscriber-text',
            ],[
                'channel' => $channel,
                'subscriber' => \Yii::$app->user->identity,
            ])
            ->setFrom(\Yii::$app->params['senderEmail'])
            ->setTo($channel->email)
            ->setSubject('You have new subscriber')
            ->send();
            
        }else{
            $subscriber->delete();
        }
        
        return $this->renderAjax('/partial/button/_subscribe_button', ['model' => $channel]);
    }

    /**
     * @param $username
     * @throws yii\web\NotFoundHttpException
    */
    protected function findChannel($username)
    {
        $channel =  User::findByUsername($username);
        if(!$channel){
            throw new NotFoundHttpException();
        }
        return $channel;
    }
}
