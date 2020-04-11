<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Dictionary;

/**
 * DictionarySearch represents the model behind the search form of `app\models\Dictionary`.
 */
class DictionarySearch extends Dictionary
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['DictionaryId', 'UserId', 'DirctionaryTypeId', 'type', 'is_defaule'], 'integer'],
            [['keyword', 'value', 'discription', 'create_date', 'last_update'], 'safe'],
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
        $query = Dictionary::find();

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
            'DictionaryId' => $this->DictionaryId,
            'UserId' => $this->UserId,
            'DirctionaryTypeId' => $this->DirctionaryTypeId,
            'type' => $this->type,
            'is_defaule' => $this->is_defaule,
            'create_date' => $this->create_date,
            'last_update' => $this->last_update,
        ]);

        $query->andFilterWhere(['like', 'keyword', $this->keyword])
            ->andFilterWhere(['like', 'value', $this->value])
            ->andFilterWhere(['like', 'discription', $this->discription]);

        return $dataProvider;
    }
}
