<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ClassTable;

/**
 * ClassTableSearch represents the model behind the search form of `app\models\ClassTable`.
 */
class ClassTableSearch extends ClassTable
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ClassId', 'UserId', 'ClassNum', 'LastUpdateUserId'], 'integer'],
            [['ClassDiscription', 'CreateTime', 'UpdateTime'], 'safe'],
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
        $query = ClassTable::find();

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
            'ClassId' => $this->ClassId,
            'UserId' => $this->UserId,
            'ClassNum' => $this->ClassNum,
            'CreateTime' => $this->CreateTime,
            'UpdateTime' => $this->UpdateTime,
            'LastUpdateUserId' => $this->LastUpdateUserId,
        ]);

        $query->andFilterWhere(['like', 'ClassDiscription', $this->ClassDiscription]);

        return $dataProvider;
    }
}
