<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "seo".
 *
 * @property integer $id
 * @property string $title
 * @property string $descritption
 * @property string $keywords
 */
class Seo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'seo';
    }



    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //[['title'], 'required'],
            [['title', 'description', 'keywords'], 'safe'],
            [['title', 'description', 'keywords'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('adminka', 'ID'),
            'title' => Yii::t('adminka', 'Title'),
            'description' => Yii::t('adminka', 'meta:Description'),
            'keywords' => Yii::t('adminka', 'meta:Keywords'),
        ];
    }
}
