<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%comment}}".
 *
 * @property int $id
 * @property string $text
 * @property string $video_id
 * @property int|null $parent_id
 * @property int $created_by
 * @property int $created_at
 * @property int|null $updated_at
 *
 * @property User $createdBy
 * @property Comment $parent
 * @property Comment[] $comments
 * @property Video $video
 */
class Comment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%comment}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['text', 'video_id', 'created_by', 'created_at'], 'required'],
            [['text'], 'string'],
            [['parent_id', 'created_by', 'created_at', 'updated_at'], 'integer'],
            [['video_id'], 'string', 'max' => 16],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
            [['parent_id'], 'exist', 'skipOnError' => true, 'targetClass' => Comment::className(), 'targetAttribute' => ['parent_id' => 'id']],
            [['video_id'], 'exist', 'skipOnError' => true, 'targetClass' => Video::className(), 'targetAttribute' => ['video_id' => 'video_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'text' => 'Text',
            'video_id' => 'Video ID',
            'parent_id' => 'Parent ID',
            'created_by' => 'Created By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[CreatedBy]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\UserQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    /**
     * Gets query for [[Parent]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\CommentQuery
     */
    public function getParent()
    {
        return $this->hasOne(Comment::className(), ['id' => 'parent_id']);
    }

    /**
     * Gets query for [[Comments]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\CommentQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comment::className(), ['parent_id' => 'id']);
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
     * @return \common\models\query\CommentQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\CommentQuery(get_called_class());
    }

    public function isLikedBy($user_id)
    {
        return CommentLike::find()->userReacted($user_id, $this->id)->liked()->one();
    }

    public function isDislikedBy($user_id)
    {
        return CommentLike::find()->userReacted($user_id, $this->id)->disliked()->one();
    }

    /**
     * @return \yii\db\ActiveQuery
    */
    public function getLikes()
    {
        return $this->hasMany(CommentLike::class, ['comment_id' => 'id'])->liked();
    }

    /**
     * @return \yii\db\ActiveQuery
    */
    public function getDislikes()
    {
        return $this->hasMany(CommentLike::class, ['comment_id' => 'id'])->disliked();
    }

}
