<?php

namespace app\models;

use kartik\daterange\DateRangeBehavior;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Item;
use yii\helpers\VarDumper;

/**
 * ItemSearch represents the model behind the search form of `app\models\Item`.
 */
class ItemSearch extends Item
{
    public $createTimeRange;
    public $start;
    public $end;

    public function behaviors()
    {
        return [
            [
                'class' => DateRangeBehavior::className(),
                'attribute' => 'createTimeRange',
                'dateStartAttribute' => 'start',
                'dateEndAttribute' => 'end',
            ]
        ];
    }


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'category_id', 'location_id', 'condition', 'status'], 'integer'],
            [['title', 'description', 'created_at', 'start', 'end'], 'safe'],
            [['price'], 'number'],
            [['createTimeRange'], 'match', 'pattern' => '/^.+\s\-\s.+$/'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Item::find();
        // add conditions that should always apply here
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);
        if (!$this->validate()) {
            var_dump($this->getErrors());
            die;
            // uncomment the following line if you do not want to return any records when validation fails
//             $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'user_id' => $this->user_id,
            'category_id' => $this->category_id,
            'location_id' => $this->location_id,
            'condition' => $this->condition,
            'price' => $this->price,
            'status' => $this->status,
//            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'description', $this->description]);

        $this->start = date('y-m-d', strtotime($this->start) - 6 * 3600);
        $this->end = strtotime($this->end);
        $query->andFilterWhere(['between', 'created_at', $this->start, $this->end]);
//            ->andFilterWhere(['<', 'created_at', $this->end]);
            echo $query->createCommand()->getRawSql();






        return $dataProvider;
    }
}
