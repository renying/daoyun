<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%UserRole}}".
 *
 * @property int $Id
 * @property int|null $UserId
 * @property int|null $RoleId
 */
class UserRole extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%UserRole}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Id'], 'required'],
            [['Id', 'UserId', 'RoleId'], 'integer'],
            [['Id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'UserId' => 'User ID',
            'RoleId' => 'Role ID',
        ];
    }
}
