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
            [['InfoId', 'ToUserId', 'FromUserId', 'InfoType','ReadType'], 'integer'],
            [['InfoContent'], 'string'],
            [['InfoDate'], 'safe'],
            [['InfoId'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'InfoId' => 'Info ID',
            'ToUserId' => 'User ID',
            'FromUserId' => 'Role ID',
            'InfoType' => 'Info Content',
            'ReadType' => 'Type',
            'InfoContent' => 'Type',
            'InfoDate' => 'Type',
        ];
    }
}
