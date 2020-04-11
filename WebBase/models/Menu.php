<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%Menu}}".
 *
 * @property int $Id
 * @property string $Right_Key
 * @property string|null $ParentKey
 * @property string|null $Right_Url
 * @property string|null $Right_Name
 * @property int|null $Right_Type
 * @property int|null $Right_Status
 * @property int|null $SortIndex
 * @property string|null $AddTime
 * @property string|null $LastUpdate
 * @property string|null $IconUrl
 * @property string|null $AddUser
 * @property int|null $IsDefaultRight
 */
class Menu extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%Menu}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Id', 'Right_Key'], 'required'],
            [['Id', 'Right_Type', 'Right_Status', 'SortIndex', 'IsDefaultRight'], 'integer'],
            [['AddTime', 'LastUpdate'], 'safe'],
            [['Right_Key'], 'string', 'max' => 128],
            [['ParentKey', 'Right_Url', 'Right_Name', 'IconUrl', 'AddUser'], 'string', 'max' => 255],
            [['Right_Key'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'Right_Key' => 'Right Key',
            'ParentKey' => 'Parent Key',
            'Right_Url' => 'Right Url',
            'Right_Name' => 'Right Name',
            'Right_Type' => 'Right Type',
            'Right_Status' => 'Right Status',
            'SortIndex' => 'Sort Index',
            'AddTime' => 'Add Time',
            'LastUpdate' => 'Last Update',
            'IconUrl' => 'Icon Url',
            'AddUser' => 'Add User',
            'IsDefaultRight' => 'Is Default Right',
        ];
    }
}
