<?php

namespace common\models;

// use common\models\query\VideoQuery;
use \Yii;
use yii\db\Query;

/**
 * This is the model class for table "{{%video_view}}".
 *
 * @property int $id
 * @property string $video_id
 * @property int $user_id
 * @property int|null $created_at
 * @property int|null $updated_at
 *
 * @property User $user
 * @property Video $video
 */
class VideoView extends \yii\db\ActiveRecord
{
    /**
    *{@inheritdoc}
    */
    public static function tableName()
    {
        return '{{%video_view}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['video_id', 'user_id'], 'required'],
            [['user_id', 'created_at', 'updated_at'], 'integer'],
            [['video_id'], 'string', 'max' => 16],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
            [['video_id'], 'exist', 'skipOnError' => true, 'targetClass' => Video::class, 'targetAttribute' => ['video_id' => 'video_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'video_id' => 'Video ID',
            'user_id' => 'User ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\UserQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    /**
     * Gets query for [[Video]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\VideoQuery
     */
    public function getVideo()
    {
        return $this->hasOne(Video::class, ['video_id' => 'video_id']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\VideoViewQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\VideoViewQuery(get_called_class());
    }

    public static function updateViews($video_id)
    {
        $user_id = Yii::$app->user->id ?  Yii::$app->user->id :  0;

        $oldRec = (new Query())->select(['id'])->from('video_view')
            ->where(['video_id' => $video_id, 'user_id' => $user_id])->one();

        if($oldRec){
            Yii::$app->db->createCommand('UPDATE video_view SET updated_at='.time().' WHERE id='.$oldRec["id"].'')->execute();
            return;
        }

        $videoView = new VideoView();
        $videoView->user_id = $user_id;
        $videoView->video_id = $video_id;
        $videoView->created_at = time();
        $videoView->save();
    }
}
