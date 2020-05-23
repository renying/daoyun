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
class Role extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%role}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['disabled', 'created_at', 'updated_at'], 'integer'],
            [['rolename', 'creator'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'roleid' => '角色ID',
            'rolename' => '角色名称',
            'created_at' => '创建时间',
            'creator' => '创建者',
            'disabled' => '禁用，0 = 否，1 = 是',
        ];
    }
}
