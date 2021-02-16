<?php 
/*@var $comments \common\models\Comment[]
*/

use yii\helpers\Url;

?>

<h5 class="mb-3 m-3 font-weight-bold">Comments</h5>


<?php foreach($comments as $comment): ?>

<div class="row m-3" style="width: 28rem;">

    <div class="embed-responsive embed-responsive-16by9 col-5">
        <a href="<?php echo Url::to(['/video/view', 'id' => $comment->video->video_id]) ?>">
            <video class="embed-responsive-item" 
                src="<?= $comment->video->getVideoLink() ?>" 
                poster="<?= $comment->video->getThumbnailLink() ?>" >
            </video>
        </a>
    </div>

    <div class="col-7">
        <?php if($comment->parent_id):?>
            <small class="text-muted">Replied to comment:</small>
            <div><?= $comment->parent->createdBy->username ?>: <?= $comment->parent->text ?></div>
            
        <?php else:?>
            <small class="text-muted">Commented the video:</small>
        <?php endif; ?>
            
        <div>You: <?= $comment->text ?></div>
    </div>
    
</div>
   
    
<?php endforeach; ?>


