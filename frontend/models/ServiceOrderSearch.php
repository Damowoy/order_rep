<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\ServiceOrder;

/**
 * ServiceOrderSearch represents the model behind the search form about `frontend\models\ServiceOrder`.
 */
class ServiceOrderSearch extends ServiceOrder
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'manager_id', 'status_id'], 'integer'],
            [['name_service', 'description', 'company', 'place', 'address'], 'safe'],
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
        $query = ServiceOrder::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'user_id' => $this->user_id,
            'manager_id' => $this->manager_id,
            'status_id' => $this->status_id,
        ]);

        $query->andFilterWhere(['like', 'name_service', $this->name_service])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'company', $this->company])
            ->andFilterWhere(['like', 'place', $this->place])
            ->andFilterWhere(['like', 'address', $this->address]);

        return $dataProvider;
    }
}
