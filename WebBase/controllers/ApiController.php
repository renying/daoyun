<?php
namespace app\controllers;
use yii\web\Controller;
class ApiController extends Controller
{
  public $enableCsrfValidation = false;
  public function actionUserLogin()
  {
    $request = \Yii::$app->request;
    echo('here');

    if ($request->isPost) {
        $username = $request->post('u');
        $password = $request->post('p');
        if('team28'==$username&&'pd'==$password){
        echo('ok');
        }
        else{
        echo('error');
        }
    }
    else{
        $result=array(
          'code'=>1001,
          'message'=>'please post the request',
          'data'=>null,
        );
        //输出json
        echo json_encode($result);
    }


  }
}