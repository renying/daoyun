<?php
namespace app_backend\controllers;

use Yii;
use yii\web\Controller;


class ApiController extends Controller
{
    public function actionUserLogin()
    {
        $request = \Yii::$app->request;
        $result=array(
            'code'=>9999,
            'msg'=>'system error',
            'data'=>null,
        );
        if ($request->isPost) {
            $username = $request->post('u');
            $password = md5( $request->post('p'));
        }
        else{
            $result=array(
              'code'=>1001,
              'msg'=>'please post the request',
              'data'=>null,
            );
        }
        echo json_encode($result);
    }

}