<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%User}}".
 *
 * @property int $UserId
 * @property string|null $UserName
 * @property string|null $NickName
 * @property string|null $BornDate
 * @property int|null $CountryId
 * @property string|null $Address
 * @property int|null $SchoolId
 * @property int|null $Phone
 * @property int|null $UserCode
 * @property string|null $RealName
 * @property int|null $UserType
 *
 * @property CheckIn[] $checkIns
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%User}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['UserId'], 'required'],
            [['UserId', 'CountryId', 'SchoolId', 'Phone', 'UserType'], 'integer'],
            [['BornDate'], 'safe'],
            [['UserName', 'NickName', 'Address', 'RealName', 'UserCode'], 'string', 'max' => 255],
            [[ 'PassWord'], 'string', 'max' => 510],
            [['UserId'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'UserId' => '用户编号',
            'UserName' => '用户名',
            'NickName' => '昵称',
            'BornDate' => '出生日期',
            'CountryId' => '国家编号',
            'Address' => '地址',
            'SchoolId' => '学校编号',
            'Phone' => '电话',
            'UserCode' => '用户唯一码',
            'RealName' => '真实姓名',
            'UserType' => '用户类型',
        ];
    }

    /**
     * Gets query for [[CheckIns]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCheckIns()
    {
        return $this->hasMany(CheckIn::className(), ['UserId' => 'UserId']);
    }
}
