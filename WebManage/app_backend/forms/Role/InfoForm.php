<?php

namespace app_backend\forms\Role;

use Yii;
use yii\base\Model;

use app_backend\models\RoleExtends;

class InfoForm extends Model
{
    public $roleid;
    public $rolename;
    public $createdate;
    public $creator;

    public function rules()
    {
        return [
            [['roleid'], 'integer'],
            [['createdate'], 'double'],
            [['rolename', 'creator'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'rolename' => '角色名',
        ];
    }

}