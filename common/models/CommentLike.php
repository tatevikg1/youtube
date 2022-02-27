<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%comment_like}}".
 *
 * @property int $id
 * @property int $comment_id
 * @property int $user_id
 * @property int|null $type
 * @property int|null $created_at
 *
 * @property Comment $comment
 * @property User $user
 */
class CommentLike extends \yii\db\ActiveRecord
{
    const TYPE_LIKE = 1;
    const TYPE_DISLIKE = 0;
    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%comment_like}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['comment_id', 'user_id'], 'required'],
            [['comment_id', 'user_id', 'type', 'created_at'], 'integer'],
            [['comment_id'], 'exist', 'skipOnError' => true, 'targetClass' => Comment::class, 'targetAttribute' => ['comment_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'comment_id' => 'Comment ID',
            'user_id' => 'User ID',
            'type' => 'Type',
            'created_at' => 'Created At',
        ];
    }

    /**
     * Gets query for [[Comment]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\CommentQuery
     */
    public function getComment()
    {
        return $this->hasOne(Comment::class, ['id' => 'comment_id']);
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
     * {@inheritdoc}
     * @return \common\models\query\CommentLikeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\CommentLikeQuery(get_called_class());
    }
}
