<?php
namespace app\controllers;
use yii\web\Controller;
class ApiController extends Controller
{
  public function actionUserLogin()
  {
    $request = \Yii::$app->request;
    if ($request->isPost) {
        $username = $request->get('u');
        $password = $request->get('p');
        if('team28'==$username&&'pd'==$password){
        echo('ok');
        }
        else{
        echo('error');
        }
    }
    else{
    echo('please post');
    }


  }
}