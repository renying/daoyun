<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%CheckIn}}".
 *
 * @property int $id
 * @property int|null $UserId
 * @property int|null $ClassId
 * @property string|null $CheckDate
 * @property int|null $CheckState
 *
 * @property User $user
 */
class CheckIn extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%CheckIn}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'UserId', 'ClassId', 'CheckState'], 'integer'],
            [['CheckDate'], 'safe'],
            [['id'], 'unique'],
            [['UserId'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['UserId' => 'UserId']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'UserId' => 'User ID',
            'ClassId' => 'Class ID',
            'CheckDate' => 'Check Date',
            'CheckState' => 'Check State',
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['UserId' => 'UserId']);
    }
}
