<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%mostop_token}}".
 *
 * @property int $id
 * @property int|null $userid
 * @property string|null $ukey
 * @property string|null $addtime
 */
class MostopToken extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%mostop_token}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['userid'], 'integer'],
            [['addtime'], 'safe'],
            [['ukey'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'userid' => 'Userid',
            'ukey' => 'Ukey',
            'addtime' => 'Addtime',
        ];
    }
}
