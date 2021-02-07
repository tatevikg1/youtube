<?php /**
 * @var $video_id \common\models\Video->video_id
 * @var $comment \common\models\Comment
*/

use yii\widgets\Pjax;

?>

<?php Pjax::begin() ?>
    <form class="comment-edit-section" method="post" data-pjax="1" 
            action="<?php echo \yii\helpers\Url::to(['/comment/create']) ?>">
        <textarea rows="1" class="form-control" name="text" placeholder="Add a public comment"></textarea>
        <input type="hidden" value="<?= $video_id ?>" name="video_id">
        <div class="action-buttons text-right mt-2">
            <button type="button" class="btn btn-light btn-cancel">Cancel</button>
            <button class="btn btn-secondary btn-save">Comment</button>
        </div>
    </form>
<?php Pjax::end() ?>
