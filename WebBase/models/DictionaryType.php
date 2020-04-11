<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%DictionaryType}}".
 *
 * @property int $DirctionaryTypeId
 * @property string|null $name
 */
class DictionaryType extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%DictionaryType}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['DirctionaryTypeId'], 'required'],
            [['DirctionaryTypeId'], 'integer'],
            [['name'], 'string'],
            [['DirctionaryTypeId'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'DirctionaryTypeId' => 'Dirctionary Type ID',
            'name' => 'Name',
        ];
    }
}
