<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Menu;

/**
 * MenuSearch represents the model behind the search form of `app\models\Menu`.
 */
class MenuSearch extends Menu
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Id', 'Right_Type', 'Right_Status', 'SortIndex', 'IsDefaultRight'], 'integer'],
            [['Right_Key', 'ParentKey', 'Right_Url', 'Right_Name', 'AddTime', 'LastUpdate', 'IconUrl', 'AddUser'], 'safe'],
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
        $query = Menu::find();

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
            'Right_Type' => $this->Right_Type,
            'Right_Status' => $this->Right_Status,
            'SortIndex' => $this->SortIndex,
            'AddTime' => $this->AddTime,
            'LastUpdate' => $this->LastUpdate,
            'IsDefaultRight' => $this->IsDefaultRight,
        ]);

        $query->andFilterWhere(['like', 'Right_Key', $this->Right_Key])
            ->andFilterWhere(['like', 'ParentKey', $this->ParentKey])
            ->andFilterWhere(['like', 'Right_Url', $this->Right_Url])
            ->andFilterWhere(['like', 'Right_Name', $this->Right_Name])
            ->andFilterWhere(['like', 'IconUrl', $this->IconUrl])
            ->andFilterWhere(['like', 'AddUser', $this->AddUser]);

        return $dataProvider;
    }
}
