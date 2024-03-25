<?php

namespace app\models;

use app\components\Translit;
use Yii;
use yii\db\ActiveRecord;

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
abstract class WebPage extends ActiveRecord
{



    protected $_breadcrumbs = null;
    protected $_extracrumbs = null;

    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_DELETED = 2;


    // Relations

    public function getSeo()
    {
        return $this->hasOne(Seo::className(),['id'=>'seo_id']);

    }

    static public function getStatusList()
    {
        return [
            static::STATUS_ACTIVE => Yii::t('adminka', 'Опубликовано'),
            static::STATUS_INACTIVE => Yii::t('adminka', 'Не опубликовано'),
            static::STATUS_DELETED => Yii::t('adminka', 'В корзине'),
        ];
    }

    public function setCrumb($crumb)
    {
        $this->_extracrumbs[] = $crumb;
        if ($this->_breadcrumbs)
        {
            $this->_breadcrumbs[] = $crumb;
        }
    }

   public function beforeValidate()
    {
        if (parent::beforeValidate())
        {
            $this->update_date = date('Y-m-d H:i:s');
            if ($this->isNewRecord)
            {
                $this->create_date = date('Y-m-d H:i:s');
                $this->user_id = Yii::$app->user->identity->getId();
            }

            if ($this->url === '')
            {
                $this->url = Translit::urlTranslit($this->name);

            }

            if ($this->h1 === '')
            {
                $this->h1 = $this->name;
            }



            return true;
        } else
        {
            return false;
        }
    }


    public function translitValidator()
    {
        if  ($this->url !== Translit::urlTranslit($this->url))
        {
            $this->addError('url', Yii::t('adminka', 'URL не является транслитом'));
        }
        return true;
    }


    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert))
        {

            if ($this->seo->title === '')
            {
                $this->seo->title = $this->name;
                $this->seo->save();
            }
            return true;
        }
        else
        {
            return false;
        }
    }

    public function beforeDelete()
    {
        if (parent::beforeDelete())
        {
            $seo = $this->seo;
            $seo->delete();

            return true;
        }
        else
        {
            return false;
        }
    }



}
