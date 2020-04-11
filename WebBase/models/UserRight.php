<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%UserRight}}".
 *
 * @property string|null $Right_Key
 * @property int|null $Enable_Flag
 * @property int $Id
 * @property int|null $UserId
 */
class UserRight extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%UserRight}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Enable_Flag', 'Id', 'UserId'], 'integer'],
            [['Id'], 'required'],
            [['Right_Key'], 'string', 'max' => 255],
            [['Id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'Right_Key' => 'Right Key',
            'Enable_Flag' => 'Enable Flag',
            'Id' => 'ID',
            'UserId' => 'User ID',
        ];
    }
}
