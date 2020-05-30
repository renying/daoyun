<?php
namespace app\controllers;
use Yii;
use yii\web\Controller;
use app\models\User;
use app\models\MostopToken;
use app\models\ClassTable;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class ApiController extends ApiBaseController
{
  
  /*
  * 接口请求方式判断、用户token判断 统一处理
  */
  public function beforeAction($action)
  {
    return parent::beforeAction($action);  
  }
  /*
  * 用户登陆接口
  */
  public function actionUserLogin()
  {
    $request = \Yii::$app->request;
   
    $username = $request->post('u');
    $password = md5( $request->post('p'));

    $userModel= new User();
    $userList = $userModel::find()->asArray()->all();
    $isSuccess=false;
    $userId='';
    $token='';
    foreach($userList as $user){
      if($user['UserName']==$username && $user['PassWord']==$password){
        $isSuccess=true;
        $userId=$user['UserId'];
        break;
      }
    }
    $token=md5(date("Y-m-d H:i:s"));
    $tokenModel= new MostopToken();
    if($isSuccess){
      $tokenModel->deleteAll("userid=".$userId);
      $tokenModel= new MostopToken();
      $tokenModel->userid=$userId;
      $tokenModel->ukey=$token;
      $tokenModel->addtime=date("Y-m-d H:i:s");

      if($tokenModel->save()){
        $result=array(
          'code'=>1,
          'msg'=>'true',
          'data'=>array(
            'userid'=>$userId,
            'ukey'=>$token,
          ),
        );
      }
    }
    else{
      $result=array(
        'code'=>1002,
        'msg'=>'username or password is wrong',
        'data'=>null,
      );
    }
    
    echo json_encode($result);

  }
  
  public function actionUserRegister()
  {
    $request = \Yii::$app->request;
    
    $username = $request->post('u');
    $password = md5( $request->post('p'));
      $model = new User();

      $maxid=$model::find()->max('UserId')+1;

      $model->UserId=$maxid;
      $model->UserName=$username;
      $model->PassWord=$password;

      $model->save();
      $result=array(
        'code'=>1,
        'msg'=>'true',
        'data'=>$maxid,
      );

    echo json_encode($result);
  }
  public function actionUserUpdateinfo(){
  	$request = \Yii::$app->request;
    
    $username = $request->post('ui');
    
    $Usermodel = new User();
    $userList = $Usermodel->find()->asArray()->all();
    $userinfo=null;
    foreach($userList as $user){
      if(md5($user['UserId'])==$username){
        $userinfo=$user;
        break;
      }
    }
    if($userinfo!=null){
      $model = User::findOne($userinfo['UserId']);
      if(!empty($request->post('NickName'))){
        $model->NickName=$request->post('NickName');
      }
      if(!empty($request->post('BornDate'))){
        $model->BornDate=$request->post('BornDate');
      }
      if(!empty($request->post('Address'))){
        $model->Address=$request->post('Address');
      }
      if(!empty($request->post('Phone'))){
        $model->Phone=$request->post('Phone');
      }
      if(!empty($request->post('UserCode'))){
        $model->UserCode=$request->post('UserCode');
      }
      if(!empty($request->post('RealName'))){
        $model->RealName=$request->post('RealName');
      }
      if(!empty($request->post('UserSex'))){
        $model->UserSex=$request->post('UserSex');
      }
      $model->save();
      $result=array(
        'code'=>1,
        'msg'=>'true',
        'data'=>$userinfo['UserId'],
      );
    }
    else{
      $result=array(
        'code'=>1002,
        'msg'=>'用户id错误：'.$username,
        'data'=>null
      );
    }
    echo json_encode($result);
  }

  public function actionGetUserinfo()
  {
    $request = \Yii::$app->request;
    
    $username = $request->post('ui');

    $userModel= new User();
    $userList = $userModel::find()->asArray()->all();
    $userinfodetail=null;
    foreach($userList as $user){
      if(md5($user['UserId'])==$username){
        $userinfodetail=$user;
        break;
      }
    }
    if($userinfodetail!=null){
    $result=array(
      'code'=>1,
      'msg'=>'true',
      'data'=>$userinfodetail,
    );
    }
    else{
      $result=array(
        'code'=>1002,
        'msg'=>'can`t find user',
        'data'=>null,
      );
    }

    echo json_encode($result);
  }

  public function actionGetClassinfo()
  {
     $request = \Yii::$app->request;
     
      
      $classModel= new ClassTable();
      $classList = $classModel::find()->asArray()->all();

      $userModel= new User();
      $userList = $userModel::find()->asArray()->all();

      foreach($classList as &$classItem){
        foreach($userList as $user){
          if($classItem['UserId']==$user['UserId']){
            $classItem['UserName']=$user['UserName'];
            $classItem['UserCode']=$user['UserCode'];
            $classItem['SchoolId']=$user['SchoolId'];
            break;
          }
        }

      }
      $result=array(
        'code'=>1,
        'msg'=>'true',
        'data'=>$classList,
      );
      echo json_encode($result);
  }

  public function actionAddClassinfo()
  {
    $request = \Yii::$app->request;

    $result=array(
      'code'=>1,
      'msg'=>'课程创建失败',
      'data'=>false,
    );
    $username = $request->post('ui');
    $className = $request->post('className');
    $classDesc = $request->post('classDesc');
    $classCode = $request->post('classCode');
    $userModel= new User();
    $userList = $userModel::find()->asArray()->all();
    $userinfodetail=null;
    foreach($userList as $user){
      if(md5($user['UserId'])==$username){
        $userinfodetail=$user;
        break;
      }
    }
    if($userinfodetail!=null){
      $classModel= new ClassTable();
      $classModel->UserId=$userinfodetail['UserId'];
      $classModel->ClassName=$className;
      $classModel->ClassDiscription=$classDesc;
      $classModel->ClassNum=$classCode;
      $classModel->CreateTime=date("Y-m-d H:i:s");
      $classModel->LastUpdateUserId=$userinfodetail['UserId'];
      if($classModel->save()){
        $result=array(
          'code'=>1,
          'msg'=>'true',
          'data'=>true,
        );
      }
      else{
        $result=array(
          'code'=>1,
          'msg'=>'课程创建失败,课程信息保存失败',
          'data'=>false,
        );
      }
    }
    else{
      $result=array(
        'code'=>1,
        'msg'=>'课程创建失败,用户信息获取失败',
        'data'=>false,
      );
    }


    echo json_encode($result);
  }

  public function actionChangePass()
  {
    $request = \Yii::$app->request;
    
    $username = $request->post('ui');
    $oldpass = $request->post('oldpass');
    $newpass = $request->post('newpass');
    
    $Usermodel = new User();
    $userList = $Usermodel->find()->asArray()->all();
    $userinfo=null;
    foreach($userList as $user){
      if(md5($user['UserId'])==$username&&$user['PassWord']==md5($oldpass)){
        $userinfo=$user;
        break;
      }
    }
    if($userinfo!=null){
      $model = User::findOne($userinfo['UserId']);
      $model->PassWord=md5($newpass);
      if($model->save()){
        $result=array(
          'code'=>1,
          'msg'=>'修改成功',
          'data'=>true,
        );
      }
      else{
        $result=array(
          'code'=>1,
          'msg'=>'修改失败',
          'data'=>false,
        );
      }
    }
    else{
      $result=array(
        'code'=>1002,
        'msg'=>'用户id或密码错误',
        'data'=>null
      );
    }
    echo json_encode($result);

  }

  public function actionGetClassuserlist(){
    $request = \Yii::$app->request;
    $usertoken = $request->post('ukey');
    echo json_encode($result);
  }
}