<?php

namespace app_backend\forms\DyClass;

use Yii;
use yii\base\Model;

use common\helpers\Common;
use common\helpers\Validator;

use app_backend\models\DyClassExtends;


class DyClassAddForm extends Model
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



    public function save()
    {
        if($this->validate())
        {
            try
            {
                $DyClass = new DyClassExtends();
                $data['DyClassExtends'] = [
                    'ClassNum' => $this->ClassNum,
                    'ClassName' => $this->ClassName,
                    'ClassDiscription' => $this->ClassDiscription,
                    'CreateTime'  => date("Y-m-d H:i:s"),
                    'UserId'  => 1,
                ];

                if($DyClass->load($data) && $DyClass->save())
                {
                    return true;
                } else {

                    $this->addError('class', '保存失败1');
                }
            } catch (\Exception $e) {
            echo $e->getMessage();
                $this->addError('class', '保存失败2');

            } catch (\Throwable $e) {
                $this->addError('class', '保存失败3');

            }

            return !$this->hasErrors();
        }
        return false;
    }
}