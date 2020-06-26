<?php

namespace app_backend\forms\Checkin;

use Yii;
use yii\base\Model;

use common\models\CheckIn;

class CheckInForm extends Model
{

    public $id;
    public $ClassName;
    public $ClassId;
    public $CheckDate;
    public $UserId;
    public $UserName;
    public $CheckState;
    public $Longitude;
    public $Latitude;

    public function rules()
    {
        return [
            [['id', 'UserId', 'ClassId', 'CheckState'], 'integer'],
            [['CheckDate'], 'safe'],
            [['Longitude','Latitude'], 'string'],
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

}