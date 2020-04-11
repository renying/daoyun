<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%StdClass}}".
 *
 * @property int $id
 * @property int|null $UserId
 * @property int|null $ClassId
 */
class StdClass extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%StdClass}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id', 'UserId', 'ClassId'], 'integer'],
            [['id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'UserId' => 'User ID',
            'ClassId' => 'Class ID',
        ];
    }
}
