<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%RoleRight}}".
 *
 * @property int $id
 * @property string|null $Right_Key
 * @property int|null $RoleId
 */
class RoleRight extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%RoleRight}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id', 'RoleId'], 'integer'],
            [['Right_Key'], 'string', 'max' => 255],
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
            'Right_Key' => 'Right Key',
            'RoleId' => 'Role ID',
        ];
    }
}
