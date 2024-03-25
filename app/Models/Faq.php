<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "faq".
 *
 * @property integer $id
 * @property string $name
 * @property string $create_date
 * @property string $update_date
 * @property integer $user_id
 * @property string $url
 * @property string $h1
 * @property integer $seo_id
 * @property integer $status
 */
class Faq extends \app\models\WebPage
{
    public $new_questions = [];
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'faq';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'create_date', 'update_date', 'user_id', 'status'], 'required'],
            [['create_date', 'update_date', 'announce', 'sort_key'], 'safe'],
            [['user_id', 'seo_id', 'status', 'sort_key'], 'integer'],
            [['h1'], 'string'],
            [['name', 'url'], 'string', 'max' => 256],
            [['sort_key'], 'default', 'value' => 0]
        ];
    }



    public function getQuestions()
    {
        return $this->hasMany(Question::className(), ['faq_id' => 'id'])->orderBy('sort ASC');
    }


    public static function published()
    {
        return self::find()->where(['status' => Faq::STATUS_ACTIVE])->with('questions')->orderBy('sort_key ASC')->all();
    }


    public function getBreadcrumbs()
    {

        if ($this->_breadcrumbs !== null)
        {
            $page_array = $this->_breadcrumbs;
        }
        else
        {

            $faq = Page::find()->where(['system_page' => Page::SYSTEM_PAGE_FAQ])->one();

            $page_array = $faq->getBreadcrumbs(false);

            $page_array[] = ['url' => false, 'name' => $this->name];

            $this->_breadcrumbs = $page_array;
        }
        return $page_array;

    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('adminka', 'ID'),
            'name' => Yii::t('adminka', 'Название темы'),
            'create_date' => Yii::t('adminka', 'Create Date'),
            'update_date' => Yii::t('adminka', 'Update Date'),
            'user_id' => Yii::t('adminka', 'User ID'),
            'url' => Yii::t('adminka', 'Url'),
            'h1' => Yii::t('adminka', 'Заголовок h1'),
            'seo_id' => Yii::t('adminka', 'Seo ID'),
            'status' => Yii::t('adminka', 'Status'),
            'announce' => Yii::t('adminka', 'Анонс'),
            'questions' => Yii::t('adminka', 'Вопросы'),
            'sort_key' => Yii::t('adminka', 'Сортировка'),
        ];


    }

    public function beforeValidate()
    {
        if (parent::beforeValidate())
        {
            $has_error = false;
            foreach(array_merge($this->questions, $this->new_questions) as $question)
            {

                if (!$question->validate() && !$question->to_delete)
                {
                    $has_error = true;
                }
            }

            if ($has_error)
            {
                $this->addError("questions", 'Ошибки в вопросах');
                return false;
            }
            else
            {
                return true;
            }


        }
        else
        {
            return false;
        }
    }


    function getAllquestions()
    {
        $questions = array_merge($this->questions, $this->new_questions);

        usort($questions, function ($a, $b) {
            return $a->sort > $b->sort;
        });

        return $questions;
    }



    public function afterSave($inset, $changedAttributes)
    {

        foreach ($this->questions as $question)
        {

            if ($question->to_delete == '1')
            {
                $question->delete();
            }
            else
            {
                $question->save();
            }

        }


        foreach ($this->new_questions as $question)
        {
            $question->faq_id = $this->id;
            if ($question->to_delete == '1')
            {
                $question->delete();
            }
            else
            {
                $question->save();
            }

        }
    }
}
