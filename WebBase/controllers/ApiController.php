<?php
namespace app\controllers;
use Yii;
use yii\web\Controller;
use app\models\User;
use app\models\ClassTable;
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
        'msg'=>'system error',
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
              'msg'=>'true',
              'data'=>$userId,
            );
        }
        else{
            $result=array(
              'code'=>1002,
              'msg'=>'username or password is wrong',
              'data'=>null,
            );
        }
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
  
  public function actionUserRegister(){
	$request = \Yii::$app->request;
    $result=array(
        'code'=>9999,
        'msg'=>'system error',
        'data'=>null,
    );
	$username = $request->post('u');
    $password = md5( $request->post('p'));
    if ($request->isPost) {
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
  
  public function actionUserUpdateinfo(){
	$request = \Yii::$app->request;
    $result=array(
        'code'=>9999,
        'msg'=>'system error',
        'data'=>null,
    );
	$username = $request->post('ui');
    if ($request->isPost) {
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
  
  public function actionGetUserinfo()
  {
      $request = \Yii::$app->request;
      $result=array(
          'code'=>9999,
          'msg'=>'system error',
          'data'=>null,
      );
      if ($request->isPost) {
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
      }
      echo json_encode($result);
  }
  
  public function actionGetClassinfo()
  {
	  $request = \Yii::$app->request;
      $result=array(
          'code'=>9999,
          'msg'=>'system error',
          'data'=>null,
      );
      if ($request->isPost) {
          
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
          
          
      }
      echo json_encode($result);
  }



}