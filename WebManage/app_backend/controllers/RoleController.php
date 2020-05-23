<?php

namespace app_backend\controllers;

use Yii;

use common\helpers\Common;
use yii\helpers\Html;
use app_backend\models\RoleExtends;

use app_backend\forms\Role\InfoForm;
use app_backend\forms\Role\RoleAddForm;
class RoleController extends MosController
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
                $search['roleid'] && $where['id'] = $search['id'];
                $search['rolename'] && $where['rolename'] = $search['rolename'];
            }

            // 分页信息
            $page = Yii::$app->request->get('page');
            $limit = Yii::$app->request->get('limit');
            $offset = ($page - 1) * $limit;
            $count = RoleExtends::find()->where($where)->andWhere($and_where)->count();

            $role_index_datas = RoleExtends::find()->where($where)->andWhere($and_where)->orderBy(['created_at' => SORT_DESC, 'roleid' => SORT_DESC])->offset($offset)->limit($limit)->asArray()->all();

            $echo_datas = [];
            if($role_index_datas)
            {
                foreach($role_index_datas as $k => $role_index_data)
                {
                    $echo_data = [
                        'roleid' => Html::encode($role_index_data['roleid']),
                        'rolename' => Html::encode($role_index_data['rolename']),
                        'creator' => Html::encode($role_index_data['creator']),
                        'created_at' => Html::encode(Common::dateFormat($role_index_data['created_at'])),
                        'disabled' => Html::encode($role_index_data['disabled']),
                        'disabled_desc' => Html::encode(RoleExtends::$disabled[$role_index_data['disabled']]),
                    ];

                    $echo_datas[] = $echo_data;
                }
            }

            return Common::echoJson(1000, '', $echo_datas, $count);
        }
        return $this->render('index', [
            'title' => '角色列表',
        ]);
    }

    public function actionRoleAdd()
    {
        $RoleAddForm = new RoleAddForm();
        if($RoleAddForm->load(Yii::$app->request->post()))
        {
            if($RoleAddForm->save())
            {
                return Common::echoJson(1000, '保存成功');
            } else {
                return Common::echoJson(1001, implode('<br>', $RoleAddForm->getFirstErrors()));
            }
        }

        return $this->render('role_add', [
            'title' => '添加角色',
            'disabled_k_v' => RoleExtends::$disabled,
        ]);
    }

    public function actionRoleDel()
    {
        $roleid = Yii::$app->request->get('roleid');
        /*
        $role_cache_data = Yii::$app->mcache->getByKey('role_datas', $roleid);
        if(!$role_cache_data)
        {
            return Common::echoJson(1001, '请选择操作角色');
        }
        */

        $Role = RoleExtends::findOne($roleid);
        if($Role->deleteRelationAll())
        {
            return Common::echoJson(1000, '删除成功');
        } else {
            return Common::echoJson(1003, implode('<br>', $Admin->getFirstErrors()));
        }
    }

}