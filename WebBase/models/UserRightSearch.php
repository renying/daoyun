<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\UserRight;

/**
 * UserRightSearch represents the model behind the search form of `app\models\UserRight`.
 */
class UserRightSearch extends UserRight
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Right_Key'], 'safe'],
            [['Enable_Flag', 'Id', 'UserId'], 'integer'],
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
        $query = UserRight::find();

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
            'Enable_Flag' => $this->Enable_Flag,
            'Id' => $this->Id,
            'UserId' => $this->UserId,
        ]);

        $query->andFilterWhere(['like', 'Right_Key', $this->Right_Key]);

        return $dataProvider;
    }
}
