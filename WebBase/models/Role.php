<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%Role}}".
 *
 * @property int $RoleId
 * @property string|null $RoleName
 * @property string|null $CreateDate
 * @property string|null $Creator
 */
class Role extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%Role}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['RoleId'], 'required'],
            [['RoleId'], 'integer'],
            [['CreateDate'], 'safe'],
            [['RoleName', 'Creator'], 'string', 'max' => 255],
            [['RoleId'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'RoleId' => 'Role ID',
            'RoleName' => 'Role Name',
            'CreateDate' => 'Create Date',
            'Creator' => 'Creator',
        ];
    }
}
