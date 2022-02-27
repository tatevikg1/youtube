<?php

namespace common\models;

use Yii;
use yii\helpers\FileHelper;
use yii\imagine\Image;
use Imagine\Image\Box;


/**
 * This is the model class for table "{{%profile}}".
 *
 * @property int $id
 * @property int $user_id
 * @property int|null $has_avatar
 *
 * @property User $user
 */
class Profile extends \yii\db\ActiveRecord
{

    /**
    * @var  \yii\web\UploadedFile
    */
    public $avatar;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%profile}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id'], 'required'],
            [['user_id'], 'integer'],
            [['has_avatar'], 'integer'],
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
            'user_id' => 'User ID',
            'has_avatar' => 'Has Avatar',
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
     * {@inheritdoc}
     * @return \common\models\query\ProfileQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\ProfileQuery(get_called_class());
    }

    public function save($runValidation = true, $attributeNames = null)
    {        
        if($this->avatar){
            $this->has_avatar = 1;
        }

        $saved =  parent::save($runValidation, $attributeNames);

        if(!$saved){
            return false;
        }

        if($this->avatar){
            $avatarPath = Yii::getAlias('@frontend/web/storage/avatars/'. $this->id .'.jpg');
            // if the avatar directory does not exists create it
            if(!is_dir(dirname($avatarPath))){
                FileHelper::createDirectory(dirname($avatarPath));
            }

            $this->avatar[0]->saveAs($avatarPath);
            Image::getImagine()->open($avatarPath)->thumbnail(new Box(1280, 1280))->save();
        }

        return true;
    }

    public function getAvatarLink()
    {
        return $this->has_avatar 
            ? Yii::$app->params['frontendUrl'] . 'storage/avatars/' . $this->id . '.jpg' 
            : '';
    }

}
