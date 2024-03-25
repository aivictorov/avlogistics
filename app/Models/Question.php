<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "question".
 *
 * @property integer $id
 * @property string $name
 * @property string $answer
 * @property string $create_date
 * @property string $update_date
 * @property integer $user_id
 * @property integer $status
 */
class Question extends \yii\db\ActiveRecord
{

    public $to_delete = false;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'question';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'answer', 'create_date', 'update_date', 'user_id'], 'required'],
            [['name', 'answer'], 'string'],
            [['create_date', 'update_date', 'to_delete'], 'safe'],
            [['user_id', 'sort'], 'integer'],
            [['sort'], 'default', 'value' => 0]
        ];
    }


    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('adminka', 'ID'),
            'name' => Yii::t('adminka', 'Вопрос'),
            'answer' => Yii::t('adminka', 'Ответ'),
            'create_date' => Yii::t('adminka', 'Create Date'),
            'update_date' => Yii::t('adminka', 'Update Date'),
            'user_id' => Yii::t('adminka', 'User ID'),
        ];
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


}
