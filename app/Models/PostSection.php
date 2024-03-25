<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "post_section".
 *
 * @property integer $id
 * @property string $name
 * @property string $create_date
 * @property string $update_date
 * @property integer $user_id
 */
class PostSection extends \yii\db\ActiveRecord
{
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_DELETED = 2;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'post_section';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'create_date', 'update_date', 'user_id', 'status'], 'required'],
            [['create_date', 'update_date'], 'safe'],
            [['user_id', 'status'], 'integer'],
            [['name'], 'string', 'max' => 256]
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

    public function getPosts()
    {
        return $this->hasMany(Post::className(), ['post_section_id' => 'id'])->orderBy('create_date ASC');
    }

    public function getPostsCount()
    {
        return count($this->posts);
    }


    public static function asidelist()
    {
        $sections = PostSection::find()->with('posts')->where(['status' => PostSection::STATUS_ACTIVE])->orderBy('name ASC')->all();
        usort($sections, function ($a, $b) {
            return $a->postsCount < $b->postsCount;
        });
        return $sections;
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

    public static function getSectionList()
    {
        $section_list = PostSection::find()->where('status <> '.PortfolioSection::STATUS_DELETED)->all();

        $list = [];
        foreach ($section_list as $section)
        {
            $list[$section->id] = $section->name;
        }
        return $list;
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
            'user_id' => Yii::t('adminka', 'User ID'),
        ];
    }
}
