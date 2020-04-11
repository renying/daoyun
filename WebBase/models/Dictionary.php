<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%Dictionary}}".
 *
 * @property int $DictionaryId
 * @property int|null $UserId
 * @property int|null $DirctionaryTypeId
 * @property string|null $keyword
 * @property int|null $type
 * @property string|null $value
 * @property string|null $discription
 * @property int|null $is_defaule
 * @property string|null $create_date
 * @property string|null $last_update
 */
class Dictionary extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%Dictionary}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['DictionaryId'], 'required'],
            [['DictionaryId', 'UserId', 'DirctionaryTypeId', 'type', 'is_defaule'], 'integer'],
            [['keyword', 'value', 'discription'], 'string'],
            [['create_date', 'last_update'], 'safe'],
            [['DictionaryId'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'DictionaryId' => 'Dictionary ID',
            'UserId' => 'User ID',
            'DirctionaryTypeId' => 'Dirctionary Type ID',
            'keyword' => 'Keyword',
            'type' => 'Type',
            'value' => 'Value',
            'discription' => 'Discription',
            'is_defaule' => 'Is Defaule',
            'create_date' => 'Create Date',
            'last_update' => 'Last Update',
        ];
    }
}
