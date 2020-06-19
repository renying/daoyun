<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%Class}}".
 *
 * @property int $ClassId
 * @property int|null $UserId
 * @property int|null $ClassNum
 * @property string|null $ClassDiscription
 * @property string|null $CreateTime
 * @property string|null $UpdateTime
 * @property int|null $LastUpdateUserId
 */
class ClassTable extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%Class}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ClassId', 'UserId', 'ClassNum', 'LastUpdateUserId'], 'integer'],
            [['ClassDiscription'], 'string'],
            [['CreateTime', 'UpdateTime'], 'safe'],
            [['ClassId'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ClassId' => 'Class ID',
            'UserId' => 'User ID',
            'ClassNum' => 'Class Num',
            'ClassDiscription' => 'Class Discription',
            'CreateTime' => 'Create Time',
            'UpdateTime' => 'Update Time',
            'LastUpdateUserId' => 'Last Update User ID',
        ];
    }
}
