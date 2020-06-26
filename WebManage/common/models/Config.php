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
class Config extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%mostop_config}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'created_at', 'updated_at'], 'integer'],
            [['pkey', 'pvalue','remark', 'creator'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => '编号',
            'pkey' => '键名',
            'pvalue' => '键值',
            'remark' => '备注',
            'created_at' => '创建时间',
            'creator' => '创建者',
            'updated_at' => '更新时间',
        ];
    }
}
