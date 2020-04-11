<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%Info}}".
 *
 * @property int $info_id
 * @property int|null $UserId
 * @property int|null $RoleId
 * @property string|null $info_content
 * @property int|null $type
 */
class Info extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%Info}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['info_id'], 'required'],
            [['info_id', 'UserId', 'RoleId', 'type'], 'integer'],
            [['info_content'], 'string'],
            [['info_id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'info_id' => 'Info ID',
            'UserId' => 'User ID',
            'RoleId' => 'Role ID',
            'info_content' => 'Info Content',
            'type' => 'Type',
        ];
    }
}
