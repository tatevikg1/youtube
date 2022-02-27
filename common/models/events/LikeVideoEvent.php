<?php
namespace common\models\events;

use le0m\broadcasting\channels\PrivateChannel;
use le0m\broadcasting\BroadcastEvent;

class LikeVideoEvent extends BroadcastEvent
{
    public $text;
    public $author;
    public $time;
    
    private $_postId;


    public function broadcastOn()
    {
        return new PrivateChannel('comments.' . $this->getPostId());
    }

    public function broadcastAs()
    {
        return 'new';
    }
    
    public function getPostId()
    {
        return $this->_postId;
    }
    
    public function setPostId($postId) {
        $this->_postId = $postId;
    }
}

