<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\User;

/**
 * UserSearch represents the model behind the search form of `app\models\User`.
 */
class UserSearch extends User
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['UserId', 'CountryId', 'SchoolId', 'Phone', 'UserCode', 'UserType'], 'integer'],
            [['UserName', 'NickName', 'BornDate', 'Address', 'RealName'], 'safe'],
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
        $query = User::find();

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
            'UserId' => $this->UserId,
            'BornDate' => $this->BornDate,
            'CountryId' => $this->CountryId,
            'SchoolId' => $this->SchoolId,
            'Phone' => $this->Phone,
            'UserCode' => $this->UserCode,
            'UserType' => $this->UserType,
        ]);

        $query->andFilterWhere(['like', 'UserName', $this->UserName])
            ->andFilterWhere(['like', 'NickName', $this->NickName])
            ->andFilterWhere(['like', 'Address', $this->Address])
            ->andFilterWhere(['like', 'RealName', $this->RealName]);

        return $dataProvider;
    }
}
