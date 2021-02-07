<?php

namespace common\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\helpers\FileHelper;
use yii\imagine\Image;
use Imagine\Image\Box;
use \common\models\VideoLike;

/**
 * This is the model class for table "{{%video}}".
 *
 * @property string $video_id
 * @property string $title
 * @property string|null $description
 * @property string|null $tags
 * @property int|null $status
 * @property int|null $has_thumbnail
 * @property string|null $video_name
 * @property int|null $created_by
 * @property int|null $created_at
 * @property int|null $updated_at
 *
 * @property User $createdBy
 */
class Video extends \yii\db\ActiveRecord
{
    const STATUS_UNPUBLISHED = 0;
    const STATUS_PUBLISHED  = 1;

    /**
    * @var  \yii\web\UploadedFile
    */
    public $video;

    /**
    * @var  \yii\web\UploadedFile
    */
    public $thumbnail;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%video}}';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::class,
            [
                'class' => BlameableBehavior::class,
                'updatedByAttribute' => false,
            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['video_id', 'title'], 'required'],
            [['description'], 'string'],
            [['status', 'has_thumbnail', 'created_by', 'created_at', 'updated_at'], 'integer'],
            [['video_id'], 'string', 'max' => 16],
            [['title', 'tags', 'video_name'], 'string', 'max' => 512],
            [['video_id'], 'unique'],
            ['status', 'default', 'value' => self::STATUS_UNPUBLISHED],
            ['has_thumbnail', 'default', 'value' => 0],
            // ['thumbnail', 'image'],
            // ['video', 'file', 'extensions' => ['mp4']],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
        ];
    }

    public function getStatusLabels()
    {
        return [
            self::STATUS_UNPUBLISHED => 'Unpublished',
            self::STATUS_PUBLISHED => 'Published',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'video_id' => 'Video ID',
            'title' => 'Title',
            'description' => 'Description',
            'tags' => 'Tags',
            'status' => 'Status',
            'has_thumbnail' => 'Has Thumbnail',
            'video_name' => 'Video Name',
            'created_by' => 'Created By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'thumbnail' => 'Thumbnail',
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
     * {@inheritdoc}
     * @return \common\models\query\VideoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\VideoQuery(get_called_class());
    }


    public function save($runValidation = true, $attributeNames = null)
    {
        $newRec = $this->isNewRecord;
        
        if($newRec){
            $this->video_id = Yii::$app->security->generateRandomString(8);
            $this->title = $this->video->name;
            $this->video_name = $this->video->name;
        }

        if($this->thumbnail){
            $this->has_thumbnail = 1;
        }

        $saved =  parent::save($runValidation, $attributeNames);

        if(!$saved){
            return false;
        }
        

        if($newRec){ 
            $videoPath = Yii::getAlias('@frontend/web/storage/videos/'. $this->video_id .'.mp4');
            // if the video directory does not exists create it
            if(!is_dir(dirname($videoPath))){
                FileHelper::createDirectory(dirname($videoPath));
            }
            $this->video->saveAs($videoPath);
        }

        if($this->thumbnail){
            $thumbnailPath = Yii::getAlias('@frontend/web/storage/thumbs/'. $this->video_id .'.jpg');
            // if the video directory does not exists create it
            if(!is_dir(dirname($thumbnailPath))){
                FileHelper::createDirectory(dirname($thumbnailPath));
            }

            $this->thumbnail[0]->saveAs($thumbnailPath);
            Image::resize($thumbnailPath, 1600, 900)->save();
            Image::getImagine()->open($thumbnailPath)->thumbnail(new Box(1280, 1280))->save();
        }

        return true;
    }

    public function getVideoLink()
    {
        return Yii::$app->params['frontendUrl'] . 'storage/videos/' . $this->video_id . '.mp4';
    }

    public function getThumbnailLink()
    {
        return $this->has_thumbnail 
            ? Yii::$app->params['frontendUrl'] . 'storage/thumbs/' . $this->video_id . '.jpg' 
            : '';
    }

    public function afterDelete()
    {
        parent::afterDelete();

        $videoPath = Yii::getAlias('@frontend/web/storage/videos/'. $this->video_id .'.mp4');
        unlink($videoPath);

        $thumbnailPath = Yii::getAlias('@frontend/web/storage/thumbs/'. $this->video_id .'.jpg');
        if(file_exists($thumbnailPath)){
            unlink($thumbnailPath);
        }
    }

    /*@return \yii\db\ActiveQuery*/
    public function getViews()
    {
        return $this->hasMany(VideoView::class, ['video_id' => 'video_id']);
    }

    public function isLikedBy($user_id)
    {
        return VideoLike::find()->userReacted($user_id, $this->video_id)->liked()->one();
    }

    public function isDisikedBy($user_id)
    {
        return VideoLike::find()->userReacted($user_id, $this->video_id)->disliked()->one();
    }

    /*@return \yii\db\ActiveQuery*/
    public function getLikes()
    {
        return $this->hasMany(VideoLike::class, ['video_id' => 'video_id'])->liked();
    }


    /*@return \yii\db\ActiveQuery*/
    public function getDislikes()
    {
        return $this->hasMany(VideoLike::class, ['video_id' => 'video_id'])->disliked();
    }

    /**
     * Gets query for [[Comments]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\CommentQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comment::class, ['video_id' => 'video_id']);
    }

}
