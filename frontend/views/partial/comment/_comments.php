<?php foreach (($comments) as $comment)
    echo $this->render('/partial/comment/_comment', ['comment' => $comment]);
