<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Products;

/**
 * ProductSearch represents the model behind the search form about `backend\models\Products`.
 */
class ProductSearch extends Products
{
    /**
     * @inheritdoc
     */
    public $productSearch;
    public function rules()
    {
        return [
            [['product_id', 'type_id', 'status', 'added_at', 'updated_at', 'views'], 'integer'],
            [['type_name', 'name','productSearch', 'descr', 'image', 'reviews'], 'safe'],
            [['price'], 'number'],
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
        $query = Products::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination'=> ['defaultPageSize' => 5],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'product_id' => $this->product_id,
            'type_id' => $this->type_id,
            'status' => $this->status,
            'price' => $this->price,
            'added_at' => $this->added_at,
            'updated_at' => $this->updated_at,
            'views' => $this->views,
        ]);

        $query->orFilterWhere(['like', 'type_name', $this->productSearch])
            ->orFilterWhere(['like', 'name', $this->productSearch])
            ->orFilterWhere(['like', 'descr', $this->productSearch])
            ->orFilterWhere(['like', 'image', $this->productSearch])
            ->orFilterWhere(['like', 'reviews', $this->productSearch])
           ->orFilterWhere(['like', 'price', $this->productSearch]);

        return $dataProvider;
    }
}
