<?php

namespace app_backend\controllers;

use Yii;

use common\helpers\Common;
use yii\helpers\Html;
use common\models\DyUser;
use common\models\CheckIn;
use app_backend\models\DyClassExtends;
use app_backend\forms\Checkin\CheckInForm;


class CheckinController extends MosController
{
    public function actionIndex()
    {
        // 分页输出
        if(Yii::$app->request->isAjax)
        {

            // 分页信息
            $page = Yii::$app->request->get('page');
            $limit = Yii::$app->request->get('limit');
            $offset = ($page - 1) * $limit;
            $count = CheckIn::find()->count();

            $role_index_datas = CheckIn::find()->orderBy(['CheckDate' => SORT_DESC, 'id' => SORT_DESC])->offset($offset)->limit($limit)->asArray()->all();

            $userModel= new DyUser();
            $userList = $userModel::find()->asArray()->all();
            
            $classList=DyClassExtends::find()->asArray()->all();


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

                    $classname='';
                    foreach($classList as $class){
                      if($class['ClassId']==$role_index_data['ClassId']){
                        $classname=$class['ClassName'];
                        break;
                      }
                    }

                    $echo_data = [
                        'id' => Html::encode($role_index_data['id']),
                        'ClassName' => Html::encode($classname),
                        'UserName' => Html::encode($username),
                        'CheckDate' => Html::encode($role_index_data['CheckDate']),
                        'Longitude' => Html::encode($role_index_data['Longitude']),
                        'Latitude' => Html::encode($role_index_data['Latitude']),
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