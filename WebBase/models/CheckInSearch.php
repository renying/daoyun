<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\CheckIn;

/**
 * CheckInSearch represents the model behind the search form of `app\models\CheckIn`.
 */
class CheckInSearch extends CheckIn
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'UserId', 'ClassId', 'CheckState'], 'integer'],
            [['CheckDate'], 'safe'],
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
        $query = CheckIn::find();

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
            'UserId' => $this->UserId,
            'ClassId' => $this->ClassId,
            'CheckDate' => $this->CheckDate,
            'CheckState' => $this->CheckState,
        ]);

        return $dataProvider;
    }
}
