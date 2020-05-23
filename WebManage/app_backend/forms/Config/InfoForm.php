<?php

namespace app_backend\forms\Config;

use Yii;
use yii\base\Model;

use app_backend\models\ConfigExtends;

class InfoForm extends Model
{

    public $pkey;
    public $pvalue;
    public $remark;
    public $createdate;
    public $creator;

    public function rules()
    {
        return [
            [['createdate'], 'double'],
            [['pkey','pvalue','remark', 'creator'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => '编号',
            'pkey' => '键名',
            'pvalue' => '键值',
            'remark' => '备注',
            'created_at' => '创建时间',
            'creator' => '创建者',
            'updated_at' => '更新时间',
        ];
    }

}