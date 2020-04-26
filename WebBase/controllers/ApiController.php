<?php
namespace app\controllers;
use Yii;
use yii\web\Controller;
use app\models\User;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class ApiController extends Controller
{
  public $enableCsrfValidation = false;
  public function actionUserLogin()
  {
    $request = \Yii::$app->request;
    $result=array(
        'code'=>9999,
        'message'=>'system error',
        'data'=>null,
    );
    if ($request->isPost) {
        $username = $request->post('u');
        $password = md5( $request->post('p'));

        $userModel= new User();
        $userList = $userModel::find()->asArray()->all();
        $isSuccess=false;
        $userId='';
        foreach($userList as $user){
            if($user['UserName']==$username && $user['PassWord']==$password){
                $isSuccess=true;
                $userId=$user['UserId'];
                break;
            }
        }
        if($isSuccess){
            $result=array(
              'code'=>1,
              'message'=>'true',
              'data'=>$userId,
            );
        }
        else{
            $result=array(
              'code'=>1002,
              'message'=>'username or password is wrong',
              'data'=>null,
            );
        }
    }
    else{
        $result=array(
          'code'=>1001,
          'message'=>'please post the request',
          'data'=>null,
        );
    }
    echo json_encode($result);

  }
}