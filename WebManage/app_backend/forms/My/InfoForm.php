<?php

namespace app_backend\forms\My;

use Yii;
use yii\base\Model;

use app_backend\models\AdminExtends;

class InfoForm extends Model
{
    public $name;
    public $sex;
    public $birthday;
    public $avatar;
    public $mobile;
    public $email;
    public $qq;
    public $weixin;
    public $usertype;
    public $address;
    public $usercode;

    public function rules()
    {
        return [
            [['sex', 'usertype'], 'integer'],
            [['birthday'], 'safe'],
            [['name'], 'string', 'max' => 20],
            [['avatar', 'email'], 'string', 'max' => 100],
            [['address'], 'string', 'max' => 255],
            [['mobile'], 'string', 'max' => 11],
            [['qq', 'weixin', 'usercode'], 'string', 'max' => 15],
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => '姓名',
            'sex' => '性别',
            'usertype' => '用户类型',
            'address' => '地址',
            'usercode' => '学号(工号)',
            'birthday' => '生日',
            'avatar' => '头像',
            'mobile' => '手机',
            'email' => '邮箱',
            'qq' => 'QQ',
            'weixin' => '微信',
        ];
    }

    public function save()
    {
        if($this->validate())
        {
            $Admin = AdminExtends::findOne(Yii::$app->user->id);
            foreach($this->getAttributes() as $field => $value)
            {
                $Admin->{$field} = $value;
            }
            return $Admin->save();
        }
        return false;
    }
}