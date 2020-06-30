<?php

namespace app_backend\models;

use Yii;
use yii\behaviors\TimestampBehavior;

use common\models\DyClass;

class DyClassExtends extends DyClass
{
    public static $disabled = [0 => '启用', 1 => '禁用'];



    /**
     * 删除管理员表及管理员相关表的数据
     * @return bool
     */
    public function deleteRelationAll()
    {
        return $this->delete();
    }
}