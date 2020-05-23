<?php

namespace app_backend\forms\Config;

use Yii;
use yii\base\Model;

use common\helpers\Common;
use common\helpers\Validator;

use app_backend\models\ConfigExtends;


class ConfigAddForm extends Model
{
    public $pkey;
    public $pvalue;
    public $remark;
    public function rules()
    {
        return [
            [['pkey','pvalue'], 'required'],
            [['pkey','pvalue','remark'], 'string', 'max' => 255],
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

    public function validateRolename($attribute, $params)
    {
        if(!$this->hasErrors())
        {
            if(Validator::rolename($this->rolename))
            {
                $user = RoleExtends::findOne(['rolename' => strtolower($this->rolename)]);
                if($user)
                {
                    $this->addError($attribute, '角色名已存在');
                }
            } else {
                $this->addError($attribute, Validator::$error);
            }
        }
    }

    public function save()
    {
        if($this->validate())
        {
            try
            {
                $Config = new ConfigExtends();
                $data['ConfigExtends'] = [
                    'pkey' => $this->pkey,
                    'pvalue' => $this->pvalue,
                    'remark' => $this->remark,
                    'creator'  => Yii::$app->user->identity->username,
                ];

                if($Config->load($data) && $Config->save())
                {
                    return true;
                } else {

                    $this->addError('role', '保存失败1');
                }
            } catch (\Exception $e) {
            echo $e->getMessage();
                $this->addError('role', '保存失败2');

            } catch (\Throwable $e) {
                $this->addError('role', '保存失败3');

            }

            return !$this->hasErrors();
        }
        return false;
    }
}