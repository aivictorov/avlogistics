<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "portfolio_section".
 *
 * @property integer $id
 * @property string $name
 * @property string $create_date
 * @property string $update_date
 */
class PortfolioSection extends \yii\db\ActiveRecord
{

    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_DELETED = 2;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'portfolio_section';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'create_date', 'update_date', 'user_id', 'status'], 'required'],
            [['create_date', 'update_date', 'sort_key'], 'safe'],
            [['user_id', 'status',  'sort_key'], 'integer'],
            [['name'], 'string', 'max' => 256],
            [['sort_key'], 'default', 'value' => 0]
        ];
    }


    static public function getStatusList()
    {
        return [
            static::STATUS_ACTIVE => Yii::t('adminka', 'Опубликовано'),
            static::STATUS_INACTIVE => Yii::t('adminka', 'Не опубликовано'),
            static::STATUS_DELETED => Yii::t('adminka', 'В корзине'),
        ];
    }


    public function getPortfolios()
    {
        return $this->hasMany(Portfolio::className(), ['portfolio_section_id' => 'id'])->where(['status' => Portfolio::STATUS_ACTIVE])->orderBy('sort_key ASC, create_date DESC');
    }

    public function getPortfoliosCount()
    {
        return count($this->portfolios);
    }


    public static function asidelist()
    {
        $sections = PortfolioSection::find()->with('portfolios')->where(['status' => PortfolioSection::STATUS_ACTIVE])->orderBy('sort_key ASC, create_date DESC')->all();
        /*usort($sections, function ($a, $b) {
            return $a->portfoliosCount < $b->portfoliosCount;
        });*/
        return $sections;
    }


    public static function getSectionList()
    {
        $section_list = PortfolioSection::find()->where('status <> '.PortfolioSection::STATUS_DELETED)->all();

        $list = [];
        foreach ($section_list as $section)
        {
            $list[$section->id] = $section->name;
        }
        return $list;
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
            return true;
        } else
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
            'status' => Yii::t('adminka', 'Статус'),
            'create_date' => Yii::t('adminka', 'Create Date'),
            'update_date' => Yii::t('adminka', 'Update Date'),
            'sort_key' => Yii::t('adminka', 'Ключ сортировки'),
        ];
    }
}
