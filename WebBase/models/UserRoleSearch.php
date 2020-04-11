<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\UserRole;

/**
 * UserRoleSearch represents the model behind the search form of `app\models\UserRole`.
 */
class UserRoleSearch extends UserRole
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Id', 'UserId', 'RoleId'], 'integer'],
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
        $query = UserRole::find();

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
            'Id' => $this->Id,
            'UserId' => $this->UserId,
            'RoleId' => $this->RoleId,
        ]);

        return $dataProvider;
    }
}
