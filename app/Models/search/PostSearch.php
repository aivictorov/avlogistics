<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Post;

/**
 * PageSearch represents the model behind the search form about `app\models\Page`.
 */
class PostSearch extends Post
{

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'status'], 'integer'],
            [['name',  'create_date', 'update_date', 'url', 'h1', 'text'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = static::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->setSort([
            'attributes' => [
                'id',
                'name',
            ]
        ]);


        if (!($this->load($params) && $this->validate())) {
            $query->andFilterWhere(['<>', 'status', static::STATUS_DELETED]);
            return $dataProvider;
        }


        $query->andFilterWhere([
            'status' => $this->status
        ]);



        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'url', $this->url])
            ->andFilterWhere(['like', 'h1', $this->h1])
            ->andFilterWhere(['like', 'status', $this->text]);

        return $dataProvider;
    }
}