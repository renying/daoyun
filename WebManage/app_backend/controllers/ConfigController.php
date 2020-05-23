<?php

namespace app_backend\controllers;

use Yii;

use common\helpers\Common;
use yii\helpers\Html;
use app_backend\models\ConfigExtends;

use app_backend\forms\Config\InfoForm;
use app_backend\forms\Config\ConfigAddForm;
use app_backend\forms\Config\ConfigEditForm;

class ConfigController extends MosController
{
    public function actionIndex()
    {
        // 分页输出
        if(Yii::$app->request->isAjax)
        {
            // 搜索条件
            $where = [];
            $and_where = ['and'];
            $search = Yii::$app->request->get('search');
            if($search)
            {
                $search['pkey'] && $where['pkey'] = $search['pkey'];
                $search['pvalue'] && $where['pvalue'] = $search['pvalue'];
            }

            // 分页信息
            $page = Yii::$app->request->get('page');
            $limit = Yii::$app->request->get('limit');
            $offset = ($page - 1) * $limit;
            $count = ConfigExtends::find()->where($where)->andWhere($and_where)->count();

            $role_index_datas = ConfigExtends::find()->where($where)->andWhere($and_where)->orderBy(['created_at' => SORT_DESC, 'id' => SORT_DESC])->offset($offset)->limit($limit)->asArray()->all();

            $echo_datas = [];
            if($role_index_datas)
            {
                foreach($role_index_datas as $k => $role_index_data)
                {
                    $echo_data = [
                        'id' => Html::encode($role_index_data['id']),
                        'pkey' => Html::encode($role_index_data['pkey']),
                        'pvalue' => Html::encode($role_index_data['pvalue']),
                        'remark' => Html::encode($role_index_data['remark']),
                        'creator' => Html::encode($role_index_data['creator']),
                        'created_at' => Html::encode(Common::dateFormat($role_index_data['created_at'])),

                    ];

                    $echo_datas[] = $echo_data;
                }
            }

            return Common::echoJson(1000, '', $echo_datas, $count);
        }
        return $this->render('index', [
            'title' => '系统参数列表',
        ]);
    }

    public function actionConfigAdd()
    {
        $ConfigAddForm = new ConfigAddForm();
        if($ConfigAddForm->load(Yii::$app->request->post()))
        {
            if($ConfigAddForm->save())
            {
                return Common::echoJson(1000, '保存成功');
            } else {
                return Common::echoJson(1001, implode('<br>', $ConfigAddForm->getFirstErrors()));
            }
        }

        return $this->render('config_add', [
            'title' => '添加参数'
        ]);
    }

    public function actionConfigDel()
    {
        $id = Yii::$app->request->get('id');


        $Config = ConfigExtends::findOne($id);
        if($Config->deleteRelationAll())
        {
            return Common::echoJson(1000, '删除成功');
        } else {
            return Common::echoJson(1003, implode('<br>', $Config->getFirstErrors()));
        }
    }
    public function actionConfigEdit()
    {
        $userid = Yii::$app->request->get('id');

        $datas = ConfigExtends::findOne($userid);



        $ConfigEditForm = new ConfigEditForm();
        if($ConfigEditForm->load(Yii::$app->request->post()))
        {
            if($ConfigEditForm->save($userid))
            {
                return Common::echoJson(1000, '保存成功');
            } else {
                return Common::echoJson(1003, implode('<br>', $ConfigEditForm->getFirstErrors()));
            }
        }

        return $this->render('config_edit', [
            'title' => '编辑参数',
            'config_data' => $datas
        ]);
    }

}