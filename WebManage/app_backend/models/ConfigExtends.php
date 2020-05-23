<?php

namespace app_backend\models;

use Yii;
use yii\behaviors\TimestampBehavior;

use common\models\Config;

class ConfigExtends extends Config
{
    public static $disabled = [0 => '启用', 1 => '禁用'];

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);
        Yii::$app->cache->delete('config_datas');
    }

    public function afterDelete()
    {
        parent::afterDelete();
        Yii::$app->cache->delete('config_datas');
    }

    public function getConfig()
    {
        return $this->hasOne(ConfigExtends::className(), ['id' => 'id'])->asArray();
    }

    /**
     * 删除管理员表及管理员相关表的数据
     * @return bool
     */
    public function deleteRelationAll()
    {
        return $this->delete();
    }
}