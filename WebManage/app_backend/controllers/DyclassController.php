<?php

namespace app_backend\controllers;

use Yii;

use common\helpers\Common;
use yii\helpers\Html;
use app_backend\models\DyClassExtends;
use common\models\DyUser;
use app_backend\forms\DyClass\DyClassForm;
use app_backend\forms\DyClass\DyClassAddForm;
use app_backend\forms\DyClass\DyClassEditForm;

class DyclassController extends MosController
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
                $search['ClassNum'] && $where['ClassNum'] = $search['ClassNum'];
                $search['ClassName'] && $where['ClassName'] = $search['ClassName'];
            }

            // 分页信息
            $page = Yii::$app->request->get('page');
            $limit = Yii::$app->request->get('limit');
            $offset = ($page - 1) * $limit;
            $count = DyClassExtends::find()->where($where)->andWhere($and_where)->count();

            $role_index_datas = DyClassExtends::find()->where($where)->andWhere($and_where)->orderBy(['CreateTime' => SORT_DESC, 'ClassId' => SORT_DESC])->offset($offset)->limit($limit)->asArray()->all();

            $userModel= new DyUser();
            $userList = $userModel::find()->asArray()->all();
            
            


            $echo_datas = [];
            if($role_index_datas)
            {
                foreach($role_index_datas as $k => $role_index_data)
                {
                    $username='';
                    foreach($userList as $user){
                      if($user['UserId']==$role_index_data['UserId']){
                        $username=$user['UserName'];
                        break;
                      }
                    }
                    $echo_data = [
                        'ClassId' => Html::encode($role_index_data['ClassId']),
                        'ClassNum' => Html::encode($role_index_data['ClassNum']),
                        'ClassName' => Html::encode($role_index_data['ClassName']),
                        'ClassDiscription' => Html::encode($role_index_data['ClassDiscription']),
                        'CreateTime' => Html::encode($role_index_data['CreateTime']),
                        'UserId' => Html::encode($username),
                        'UpdateTime' => Html::encode($role_index_data['UpdateTime']),

                    ];

                    $echo_datas[] = $echo_data;
                }
            }

            return Common::echoJson(1000, '', $echo_datas, $count);
        }
        else{

        }
        return $this->render('index', [
            'title' => '班课管理列表',
        ]);
    }

    public function actionDyclassAdd()
    {
        $DyClassAddForm = new DyClassAddForm();
        if($DyClassAddForm->load(Yii::$app->request->post()))
        {
            if($DyClassAddForm->save())
            {
                return Common::echoJson(1000, '保存成功');
            } else {
                return Common::echoJson(1001, implode('<br>', $DyClassAddForm->getFirstErrors()));
            }
        }

        return $this->render('dyclass_add', [
            'title' => '添加参数'
        ]);
    }

    public function actionDyclassDel()
    {
        $id = Yii::$app->request->get('id');


        $Config = DyClassExtends::findOne($id);
        if($Config->deleteRelationAll())
        {
            return Common::echoJson(1000, '删除成功');
        } else {
            return Common::echoJson(1003, implode('<br>', $Config->getFirstErrors()));
        }
    }
    public function actionDyclassEdit()
    {
        $userid = Yii::$app->request->get('id');

        $datas = DyClassExtends::findOne($userid);



        $DyClassEditForm = new DyClassEditForm();
        if($DyClassEditForm->load(Yii::$app->request->post()))
        {
            if($DyClassEditForm->save($userid))
            {
                return Common::echoJson(1000, '保存成功');
            } else {
                return Common::echoJson(1003, implode('<br>', $DyClassEditForm->getFirstErrors()));
            }
        }

        return $this->render('dyclass_edit', [
            'title' => '编辑参数',
            'dyclass_data' => $datas
        ]);
    }

}