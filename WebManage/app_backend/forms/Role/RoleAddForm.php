<?php

namespace app_backend\forms\Role;

use Yii;
use yii\base\Model;

use common\helpers\Common;
use common\helpers\Validator;

use app_backend\models\RoleExtends;


class RoleAddForm extends Model
{
    public $rolename;
    public $disabled;
    public function rules()
    {
        return [
            [['rolename'], 'required'],
            [['rolename'], 'string', 'max' => 255],
            [['disabled'], 'integer'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'rolename' => '角色名',
            'disabled' => '状态',
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
                $Role = new RoleExtends();
                $data['RoleExtends'] = [
                    'rolename' => strtolower($this->rolename),
                    'creator'  => Yii::$app->user->identity->username,
                    'disabled' => $this->disabled,
                ];

                if($Role->load($data) && $Role->save())
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