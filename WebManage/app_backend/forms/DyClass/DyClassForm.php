<?php

namespace app_backend\forms\Config;

use Yii;
use yii\base\Model;

use app_backend\models\DyClassExtends;

class DyClassForm extends Model
{

    public $ClassNum;
    public $ClassName;
    public $ClassId;
    public $ClassDiscription;
    public $CreateTime;
    public $UserId;
    public $UpdateTime;

    public function rules()
    {
        return [
            [['ClassId','UserId'], 'integer'],
            [['ClassName','ClassNum','ClassDiscription', 'CreateTime','UpdateTime'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'ClassId' => '编号',
            'ClassName' => '课程名',
            'ClassNum' => '课程编号',
            'ClassDiscription' => '课程简介',
            'CreateTime' => '创建时间',
            'UserId' => '创建者',
            'UpdateTime' => '更新时间',
        ];
    }

}