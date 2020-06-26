<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%Role}}".
 *
 * @property int $RoleId
 * @property string|null $RoleName
 * @property string|null $CreateDate
 * @property string|null $Creator
 */
class DyClass extends \yii\db\ActiveRecord
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
            [['ClassDiscription','ClassName'], 'string'],
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
