<?php

namespace app\models;

use Yii;
use app\models\images\ImagePostAvatar;
use shvedovka\imageuploader\ImageUploader;
use yii\helpers\Html;

/**
 * This is the model class for table "post".
 *
 * @property integer $id
 * @property string $name
 * @property string $create_date
 * @property string $update_date
 * @property integer $user_id
 * @property string $url
 * @property string $h1
 * @property string $text
 * @property string $announce
 * @property integer $seo_id
 * @property integer $status
 */
class Post extends \app\models\WebPage
{


    public $new_avatar = null;



    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'post';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'create_date', 'update_date', 'user_id', 'post_section_id', 'announce', 'status', 'date'], 'required'],
            [['post_section_id', 'user_id', 'seo_id', 'status'], 'integer'],
            [['date'], 'date', 'format' => 'php:d / m / Y'],
            [['text'], 'safe'],
            [['name', 'h1', 'text', 'announce'], 'string'],
            [['url', 'name'], 'string', 'max' => 256],
            [['url'], 'translitValidator'],
            [['url'], 'unique'],
        ];
    }

    public function getAvatar()
    {
        return $this->hasOne(ImagePostAvatar::className(), ['parent_id' => 'id']);
    }


    public static function headerlist()
    {
        return Post::find()->where(['status' => Post::STATUS_ACTIVE])->limit(5)->orderBy('date DESC')->all();
    }

    public function afterDelete()
    {
        parent::afterDelete();


        $avatar = $this->avatar;
        if ($avatar)
        {
            $avatar->delete();
        }

        $path = 'upload/post_avatar/' . $this->id.'/';
        ImageUploader::fullDeleteDir($path);
    }


    public function beforeSave($insert)
    {
        preg_match("|(.*) / (.*) / (.*)|", $this->date, $arr);

        $this->date = date('Y-m-d', strtotime($arr[3].'-'.$arr[2].'-'.$arr[1]));
        return parent::beforeSave($insert);
    }

    public function afterFind()
    {
        $this->date = date('d / m / Y', strtotime($this->date));
        parent::afterFind();
    }


    public function getBreadcrumbs()
    {

        if ($this->_breadcrumbs !== null)
        {
            $page_array = $this->_breadcrumbs;
        }
        else
        {

            $blog = Page::find()->where(['system_page' => Page::SYSTEM_PAGE_BLOG])->with('seo')->one();

            $page_array = $blog->getBreadcrumbs(false);

            $page_array[] = ['url' => false, 'name' => $this->name];

            $this->_breadcrumbs = $page_array;
        }
        return $page_array;

    }

    public function afterSave($inset, $changedAttributes)
    {
        if ($this->new_avatar)
        {
            $avatar = $this->new_avatar;
            $avatar->parent_id = $this->id;

            $old_avatar = $this->avatar;
            if ($avatar->save())
            {
                if ($old_avatar)
                {
                    $old_avatar->delete();
                }
            }
        }
        else
        {
            $avatar = $this->avatar;
            if ($avatar)
            {
                $avatar->save();
            }
        }
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {

        return [
            'id' => Yii::t('adminka','ID'),
            'name' => Yii::t('adminka','Название'),
            'create_date' => Yii::t('adminka','Дата создания'),
            'update_date' => Yii::t('adminka','Дата обновления'),
            'user_id' => Yii::t('adminka','Автор'),
            'url' => Yii::t('adminka','URL'),
            'h1' => Yii::t('adminka','Заголовок h1'),
            'post_section_id' => Yii::t('adminka','Рубрика'),
            'text' => Yii::t('adminka','Текст'),
            'announce' => Yii::t('adminka', 'Анонс'),
            'status' => Yii::t('adminka','Статус'),
        ];

    }
}
