<?php

namespace app\models;

use Yii;
use yii\helpers\Html;
use shvedovka\imageuploader\ImageUploader;
use app\models\images\ImagePageAvatar;


/**
 * This is the model class for table "page".
 *
 * @property integer $id
 * @property string $name
 * @property string $create_date
 * @property string $update_date
 * @property integer $user_id
 * @property string $h1
 * @property integer $status
 */
class Page extends \app\models\WebPage
{


    public $new_avatar = null;

    const SYSTEM_PAGE_INDEX = 1;
    const SYSTEM_PAGE_ABOUT = 2;
    const SYSTEM_PAGE_ZHD = 3;
    const SYSTEM_PAGE_SCHEME = 4;
    const SYSTEM_PAGE_CONTACTS = 5;
    const SYSTEM_PAGE_BLOG = 6;
    const SYSTEM_PAGE_PORTFOLIO = 7;
    const SYSTEM_PAGE_FAQ = 8;
    const SYSTEM_PAGE_LOGIN = 9;

    const MENU_SHOW = 1;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'page';
    }


    public function getAvatar()
    {
        return $this->hasOne(ImagePageAvatar::className(), ['parent_id' => 'id']);
    }



    public function afterDelete()
    {
        parent::afterDelete();


        $avatar = $this->avatar;
        if ($avatar)
        {
            $avatar->delete();
        }

        $path = 'upload/page_avatar/' . $this->id.'/';
        ImageUploader::fullDeleteDir($path);
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
    public function rules()
    {
        return [
            [['name', 'create_date', 'update_date', 'status'], 'required'],
            [['create_date', 'update_date', 'url', 'h1', 'text', 'parent_id', 'system_page', 'menu_sort', 'menu_show'], 'safe'],
            [['user_id', 'status', 'parent_id', 'system_page', 'menu_sort', 'menu_show'], 'integer'],
            [['url'], 'translitValidator'],
            [['url'], 'unique'],
            [['url', 'name'], 'string', 'max' => 256],
            [['parent_id', 'system_page', 'menu_sort'], 'default', 'value' => 0],
        ];
    }

    // Relations


    public function getParent()
    {
        return $this->hasOne(Page::className(), ['id' => 'parent_id']);
    }



    public function getChildren()
    {
        return $this->hasMany(Page::className(), ['parent_id' => 'id'])->where(['status' => Page::STATUS_ACTIVE, 'menu_show' => Page::MENU_SHOW])->orderBy('menu_sort ASC');
    }



    public function getCrumbParentList()
    {
        if ($this->id)
        {

            $pages = $this->children;


            $inlist = [];
            foreach ($pages as $page)
            {
                $inlist[] = $page->id;
                $inlist[] = $page->parent_id;
            }

            $pages = Page::find()
                ->where(['IN', 'parent_id', $inlist]);
            $pages = $pages->all();


            foreach ($pages as $page)
            {
                $inlist[] = $page->id;
                $inlist[] = $page->parent_id;
            }

            $pages = Page::find()
                ->where(['IN', 'parent_id', $inlist]);
            $pages = $pages->all();


            foreach ($pages as $page)
            {
                $inlist[] = $page->id;
                $inlist[] = $page->parent_id;
            }


            $pages = Page::find()->where(['<>', 'status', Page::STATUS_DELETED])
                ->where(['NOT IN', 'parent_id', $inlist])
                ->andWhere(['!=', 'id', $this->id]);
            $pages = $pages->all();


        }
        else
        {
            $pages = Page::find()->where(['<>', 'status', Page::STATUS_DELETED]);
            $pages = $pages->all();

        }
        $returnlist = [];
        foreach ($pages as $page)
        {
            $returnlist[$page->id] = $page->name;
        }
        return $returnlist;

    }

    private function inCrumbTree($parent)
    {
        if ($parent->parent_id == $this->id)
        {
            return true;
        }
        if ($parent->parent)
        {
            return $this->inCrumbTree($parent->parent);
        }
        else
        {
            return false;
        }


    }


    public function getBreadcrumbs()
    {

        if ($this->_breadcrumbs == null)
        {
            $parent_breadcrumbs = $this->getParentBreadcrumbs($this->parent, [$this->id => true]);
            $page_array = [];
            foreach ($parent_breadcrumbs as $page)
            {
                $page_array[$page->id] = ['url' => Html::a($page->name, ['site/page', 'url' => $page->url]), 'name' => $page->name];
            }

            $url = Html::a($this->name, ['site/page', 'url' => $this->url]);

            $page_array[$this->id] = ['url' => $url, 'name' => $this->name];
            $this->_breadcrumbs = $page_array;
        }
        if ($this->_extracrumbs && is_array($this->_extracrumbs))
        {
            return array_merge($this->_breadcrumbs, $this->_extracrumbs);
        }
        else
        {
            return $this->_breadcrumbs;
        }

    }

    public function getParentBreadcrumbs($parent, $prelist)
    {
        if ($parent)
        {
            if (isset($prelist[$parent->id]))
            {
                return [];
            }

            $prelist[$this->id] = true;

            if ($parent->parent_id)
            {
                $parents = $this->getParentBreadcrumbs($parent->parent, $prelist);
            }
            else {
                $parents = [];
            }

            return array_merge($parents, [$parent->id => $parent]);
        }
        else
        {
            return [];
        }
    }

    public static function getSystemPage($system_id)
    {
        return Page::find()->where(['system_page' => $system_id, 'status' => 1])->with('seo')->one();
    }


    public static function getSystemPages()
    {
        return [
            self::SYSTEM_PAGE_INDEX => "Главная",
            self::SYSTEM_PAGE_ABOUT => "О компании",
            self::SYSTEM_PAGE_ZHD => "ЖД перевозки",
            self::SYSTEM_PAGE_SCHEME => "Схемы погрузки",
            self::SYSTEM_PAGE_CONTACTS => "Контакты",
            self::SYSTEM_PAGE_BLOG => "Блог",
            self::SYSTEM_PAGE_PORTFOLIO => "Портфолио",
            self::SYSTEM_PAGE_FAQ => "Вопросы и ответы",
            self::SYSTEM_PAGE_LOGIN => "Вход",
        ];
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
            'parent_id' => Yii::t('adminka','Страница родитель'),
            'menu_sort' => Yii::t('adminka','Порядок вывода'),
            'menu_show' => Yii::t('adminka','Отображать в меню'),
            'text' => Yii::t('adminka','Текст'),
            'status' => Yii::t('adminka','Статус'),
            'avatar' => Yii::t('adminka','Изображение'),
            'system_page' => Yii::t('adminka','Системаня страница'),
        ];
    }
}
