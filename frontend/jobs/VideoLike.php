<?php
namespace frontend\jobs;

use common\models\VideoLike as ModelsVideoLike;
use yii\base\BaseObject;
use yii\queue\JobInterface;

class VideoLike extends BaseObject implements JobInterface
{
    public $userId;
    public $videoId;

    public function execute($queue)
    {
        $videoReaction = ModelsVideoLike::find()->userReacted($this->userId, $this->videoId)->one();

        if (!$videoReaction) {
            $videoReaction = new ModelsVideoLike();
            $videoReaction->video_id = $this->videoId;
            $videoReaction->user_id = $this->userId;
            $videoReaction->type = ModelsVideoLike::TYPE_DISLIKE;
            $videoReaction->created_at = time();
            $videoReaction->save();
    
        } else if ($videoReaction->type == ModelsVideoLike::TYPE_DISLIKE) {
            $videoReaction->delete();
        } else {
            $videoReaction->delete();

            $videoReaction = new ModelsVideoLike();
            $videoReaction->video_id = $this->videoId;
            $videoReaction->user_id = $this->userId;
            $videoReaction->type = ModelsVideoLike::TYPE_DISLIKE;
            $videoReaction->created_at = time();
            $videoReaction->save();
        }
    }
}