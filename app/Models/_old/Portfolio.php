<?php

namespace app\models;

use Yii;
use app\models\images\ImagePortfolioAvatar;
use app\models\images\ImagePortfolioImage;
use app\models\PortfolioSection;
use shvedovka\imageuploader\ImageUploader;

/**
 * This is the model class for table "portfolio".
 *
 * @property integer $id
 * @property string $name
 * @property string $create_date
 * @property string $update_date
 * @property integer $portfolio_section_id
 * @property integer $user_id
 * @property string $h1
 * @property integer $status
 * @property string $image
 * @property string $text
 * @property integer $seo_id
 */
class Portfolio extends WebPage
{
    /**
     * @inheritdoc
     */

    public $new_images = [];
    public $new_avatar = null;



    public static function tableName()
    {
        return 'portfolio';
    }

    public function getImages()
    {
        return $this->hasMany(ImagePortfolioImage::className(), ['parent_id' => 'id'])->orderBy('sort ASC');
    }

    public function getAvatar()
    {
        return $this->hasOne(ImagePortfolioAvatar::className(), ['parent_id' => 'id']);
    }


    public function getSection()
    {
        return $this->hasOne(PortfolioSection::className(), ['id' => 'portfolio_section_id']);
    }

    /**
     *
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'create_date', 'update_date', 'portfolio_section_id', 'user_id', 'status'], 'required'],
            [['name', 'h1', 'text'], 'string'],
            [['url', 'name'], 'string', 'max' => 256],
            [['text', 'sort_key'], 'safe'],
            [['portfolio_section_id', 'user_id', 'status', 'seo_id', 'sort_key'], 'integer'],
            [['url'], 'translitValidator'],
            [['url'], 'unique'],
            [['sort_key'], 'default', 'value' => 0]
            //[['imagefile'], 'file', 'maxFiles' => 1, 'extensions' => 'jpg, png, bmp, gif', 'maxSize' => 20 * 1024 * 1024 * 1024, 'mimeTypes' => 'image/jpeg, image/png, image/bmp, image/gif',],

        ];
    }



    public static function headerlist()
    {
        $headerist = Portfolio::find()->where(['status' => Portfolio::STATUS_ACTIVE])->limit(10)->with('avatar')->orderBy('create_date DESC')->all();
        $returnlist = [];
        foreach ($headerist as $portfolio_item)
        {
            if ($portfolio_item->avatar)
            {
                $returnlist[] = $portfolio_item;
            }
        }
        return $returnlist;
    }

    public function afterDelete()
    {
        parent::afterDelete();

        foreach ($this->images as $image)
        {
            $image->delete();
        }

        $avatar = $this->avatar;
        if ($avatar)
        {
            $avatar->delete();
        }


        $path = 'upload/portfolio_avatar/' . $this->id.'/';
        ImageUploader::fullDeleteDir($path);

        $path = 'upload/portfolio_image/' . $this->id.'/';
        ImageUploader::fullDeleteDir($path);
    }

    public function getBreadcrumbs()
    {

        if ($this->_breadcrumbs !== null)
        {
            $page_array = $this->_breadcrumbs;
        }
        else
        {

            $portfolio = Page::find()->where(['system_page' => Page::SYSTEM_PAGE_PORTFOLIO])->one();

            $page_array = $portfolio->getBreadcrumbs(false);

            $page_array[] = ['url' => false, 'name' => $this->name];

            $this->_breadcrumbs = $page_array;
        }
        return $page_array;

    }

    public function afterSave($inset, $changedAttributes)
    {

        foreach ($this->images as $image)
        {
            $image->save();
        }


        foreach ($this->new_images as $image)
        {
            $image->parent_id = $this->id;
            $image->save();
        }


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




    public function beforeValidate()
    {

        if (parent::beforeValidate())
        {
            return true;
        }
        else
        {
            return false;
        }

    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('adminka', 'ID'),
            'name' => Yii::t('adminka', 'Название'),
            'create_date' => Yii::t('adminka', 'Дата создания'),
            'update_date' => Yii::t('adminka', 'Дата обновления'),
            'portfolio_section_id' => Yii::t('adminka', 'Категория портфолио'),
            'user_id' => Yii::t('adminka', 'Автор'),
            'h1' => Yii::t('adminka', 'Заголовок h1'),
            'status' => Yii::t('adminka', 'Статус'),
            'images' => Yii::t('adminka', 'Фотографии портфолио'),
            'avatar' => Yii::t('adminka', 'Аватарка'),
            'text' => Yii::t('adminka', 'Текст'),
            'sort_key' => Yii::t('adminka', 'Ключ сортировки'),
            'seo_id' => Yii::t('adminka', 'Seo ID'),
        ];
    }
}
