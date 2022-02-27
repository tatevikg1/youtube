<?php

namespace common\models\query;

use common\models\CommentLike;

/**
 * This is the ActiveQuery class for [[\common\models\CommentLike]].
 *
 * @see \common\models\CommentLike
 */
class CommentLikeQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \common\models\CommentLike[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\CommentLike|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    public function userReacted($user_id, $comment_id)
    {
        return $this->andWhere([
            'comment_id' => $comment_id,
            'user_id'  => $user_id,
        ]);
    }

    public function liked()
    {
        return $this->andWhere(['type' => CommentLike::TYPE_LIKE]);
    }

    public function disliked()
    {
        return $this->andWhere(['type' => CommentLike::TYPE_DISLIKE]);
    }
}
