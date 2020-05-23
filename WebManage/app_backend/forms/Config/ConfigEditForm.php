<?php

namespace app_backend\forms\Config;

use Yii;
use yii\base\Model;

use common\helpers\Common;
use common\helpers\Validator;

use app_backend\models\ConfigExtends;

class ConfigEditForm extends Model
{
    public $pvalue;
    public $remark;

    public function rules()
    {
        return [
            [['pvalue'], 'required'],
            [['pvalue', 'remark'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'pkey' => '键名',
            'pvalue' => '键值',
            'remark' => '备注',
        ];
    }


    public function save($id)
    {
        if($this->validate())
        {

            try
            {
                $Config = ConfigExtends::findOne($id);
                $Config->pvalue = $this->pvalue;
                $Config->remark = $this->remark;


                if($Config->save())
                {
                    return true;
                }

            } catch (\Exception $e) {
                echo $e->getMessage();
                $this->addError('password', '保存失败2');
            } catch (\Throwable $e) {
                $this->addError('password', '保存失败3');
            }

            return !$this->hasErrors();
        }
        return false;
    }
}