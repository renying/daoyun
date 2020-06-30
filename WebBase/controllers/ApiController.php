<?php
namespace app\controllers;
use Yii;
use yii\web\Controller;
use app\models\User;
use app\models\MostopToken;
use app\models\ClassTable;
use app\models\StdClass;
use app\models\CheckIn;
use app\models\Info;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;


date_default_timezone_set("Asia/Shanghai");

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
  * 一、登陆校验接口
  */
  public function actionUserLogin()
  {
    $request = \Yii::$app->request;
   
    $username = $request->post('u');
    $password = md5( $request->post('p'));
    $usertype = $request->post('ut');
    $userList = null;


    $userModel= new User();
    if($usertype!=null&&$usertype=='6')
    {
      $userList = $userModel::find()->where(['UserType' => '1'])->asArray()->all();
    }
    else{
      $userList = $userModel::find()->asArray()->all();
    }
    $isSuccess=false;
    $userId='';
    $token='';
    foreach($userList as $user){
      if($user['UserName']==$username && $user['PassWord']==$password){
        $isSuccess=true;
        $userId=$user['UserId'];
        break;
      }
      elseif ($user['Phone']==$username && $user['PassWord']==$password) {
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
  /*
  * 二、用户注册接口 
  */
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
  /*
  * 三、用户信息修改接口 
  */
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
  /*
  * 四、用户信息获取接口 
  */
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
  /*
  * 五、班课信息获取接口
  */
  public function actionGetClassinfo()
  {
    $request = \Yii::$app->request;
    $realUser=null;
    $result=array();
    $res=array();
   
    $userid = $request->post('ui');
    $classModel= new ClassTable();
    

    $userModel= new User();
    $userList = $userModel::find()->asArray()->all();


    foreach($userList as $user){
      if(md5($user['UserId'])==$userid){
        $realUser=$user;
      }
    }
    if($realUser!=null){
      $stdModel = new StdClass();
      $stdList = $stdModel::find()->where(['UserId' => $realUser['UserId']])->asArray()->all();
      $classids = [];

      foreach ($stdList as $key => $value) {
        $classids[]=$value['ClassId'];
      }

      $classList = $classModel::find()->asArray()->all();
      $joined=[];
      $created=[];
      foreach($classList as $classItem){
        $classinfo=array();
        $classinfo['ClassId']=$classItem['ClassId'];
        $classinfo['ClassName']=$classItem['ClassName'];
        $classinfo['ClassCode']=$classItem['ClassNum'];
        $classinfo['ClassDesc']=$classItem['ClassDiscription'];
        $classinfo['CreateTime']=$classItem['CreateTime'];
        foreach($userList as $user){
          if($classItem['UserId']==$user['UserId']){
            $classinfo['UserName']=$user['UserName'];
            $classinfo['UserCode']=$user['UserCode'];
            $classinfo['SchoolId']=$user['SchoolId'];
            break;
          }
        }
        if($classItem['UserId']==$realUser['UserId']){
          $created[]=$classinfo;
        }
        else if(in_array($classItem['ClassId'], $classids)){
          $joined[]=$classinfo;
        }

      }
      $res['Joined']=$joined;
      $res['Created']=$created;
      $result=array(
        'code'=>1,
        'msg'=>'true',
        'data'=>$res,
      );
    }
    else{
      $result=array(
        'code'=>1002,
        'msg'=>'用户信息有误',
        'data'=>false,
      );
    }
    echo json_encode($result);
  }
    /*
  * 六、班课成员信息获取接口 
  */
  public function actionGetClassuserlist(){
    $request = \Yii::$app->request;
    $userid = $request->post('ui');
    $classid = $request->post('classid');

    $classModel= new ClassTable();
    $classInfo = $classModel::find()->where(['ClassId' => $classid])->asArray()->one();
    $res=array();

    $realId=0;

    if($classInfo!=null){
      $userModel= new User();
      $userList = $userModel::find()->asArray()->all();
      $stdModel = new StdClass();
      $stdList=$stdModel::find()->where(['ClassId' => $classid])->asArray()->all();
      if($stdList!=null){
        $res['UserCount']=count($stdList);
        $resUserList=array();
        foreach($stdList as $classItem){
          foreach($userList as $user){
            $resuserinfo=array();
            if(md5($user['UserId'])==$userid){
              $realId=$user['UserId'];
            }
            if($classItem['UserId']==$user['UserId']){
              $resuserinfo['UserId']=$user['UserId'];
              $resuserinfo['UserName']=$user['UserName'];
              $resuserinfo['UserCode']=$user['UserCode'];
              $resUserList[]=$resuserinfo;
              break;
            }
          }
        }
        $res['UserList']=$resUserList;

        $CheckinModel = new CheckIn();
        $chklist= $CheckinModel::find()->where(['UserId' => $realId])->asArray()->all();
        $res['CheckCount']=count($chklist);
      }
      else{
        $res['UserCount']=0;
        $res['UserList']=null;
      }
      $res['ClassName']=$classInfo['ClassName'];

      $result=array(
        'code'=>1,
        'msg'=>'true',
        'data'=>$res,
      );

    }
    else{
      $result=array(
        'code'=>1001,
        'msg'=>'不存在此课程信息',
        'data'=>false,
      );
    }
    echo json_encode($result);
  }
  /*
  * 七、消息通知列表获取
  */
  public function actionGetUsernoticelist(){
    $request = \Yii::$app->request;
    $userid = $request->post('ui');
    $infoModel= new Info();
    $userModel= new User();
    $userList = $userModel::find()->asArray()->all();
    $realUser=null;
    $result=array();
    $res=array();
    $resMd5=array();
    foreach($userList as $user){
      if(md5($user['UserId'])==$userid){
        $realUser=$user;
      }
    }
    if($realUser['UserId']>0){
      $infolist= $infoModel::find()->where(['ToUserId' => $realUser['UserId']])->asArray()->all();
      foreach($infolist as $infoItem){
        foreach($userList as $user){
          $infoinfo=array();
          if($infoItem['FromUserId']==$user['UserId']){

            $infoinfo['FromName']=$user['UserName'];
            $infoinfo['FromUserId']=$user['UserId'];
            $infoinfo['NoticeType']=$infoItem['InfoType'];
            $infoinfo['HasNew']=$infoItem['ReadType']==0;
            if(!in_array($user['UserName'], $resMd5)){
              $resMd5[]=$user['UserName'];
              $res[]=$infoinfo;
            }
            else{
              if($infoinfo['HasNew']){
                foreach ($resMd5 as $key => $v)
                {
                    if($v==$user['UserName'])
                    {
                      $res[$key]['HasNew']=true;
                    }
                }
              }

            }
            break;
          }
        }
      }
      $result=array(
        'code'=>1,
        'msg'=>'true',
        'data'=> array('NoticeList' => $res ),
      );

    }
    else{
      $result=array(
        'code'=>1002,
        'msg'=>'用户信息有误',
        'data'=>false,
      );
    }
    echo json_encode($result);
  }

  public function actionGetNoticeinfolist(){
    $request = \Yii::$app->request;
    $FromUserId = $request->post('FromUserId');
    $ToUserId = $request->post('ToUserId');
    $infoModel= new Info();
    $userModel= new User();
    $userList = $userModel::find()->asArray()->all();
    $result=array();
    $res=array();
    $fromUser=null;
    $toUser=null;
    foreach($userList as $user){
      if(md5($user['UserId'])==$FromUserId){
        $fromUser=$user;
      }
      if(md5($user['UserId'])==$ToUserId){
        $toUser=$user;
      }
    }
    if($fromUser!=null&&$toUser!=null){
      $infolist= $infoModel::find()->where(['ToUserId' => $toUser['UserId'],'FromUserId' => $fromUser['UserId']])->asArray()->all();
      foreach($infolist as $infoItem){
        $infoinfo=array();
        $infoinfo['FromName']=$fromUser['UserName'];
        $infoinfo['ToName']=$toUser['UserName'];
        $infoinfo['NoticeType']=$infoItem['InfoType'];
        $infoinfo['InfoContent']=$infoItem['InfoContent'];
        $infoinfo['InfoDate']=$infoItem['InfoDate'];
        $infoinfo['ReadType']=$infoItem['ReadType']==1;
        $res[]=$infoinfo;  
      }
      $result=array(
        'code'=>1,
        'msg'=>'true',
        'data'=> array('NoticeList' => $res ),
      );
      Info::updateAll(['ReadType' => 1],['ToUserId' => $toUser['UserId'],'FromUserId' => $fromUser['UserId']]);
    }
    else{
      $result=array(
        'code'=>1002,
        'msg'=>'用户信息有误',
        'data'=>false,
      );
    }




    echo json_encode($result);
  }


  /*
  * 九、创建班课接口 
  */
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
          'code'=>1001,
          'msg'=>'课程创建失败,课程信息保存失败',
          'data'=>false,
        );
      }
    }
    else{
      $result=array(
        'code'=>1002,
        'msg'=>'课程创建失败,用户信息获取失败',
        'data'=>false,
      );
    }


    echo json_encode($result);
  }
  /*
  * 十、修改密码接口 
  */
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
  /*
  * 十一、课堂签到接口
  */
  public function actionCheckin()
  {
    $request = \Yii::$app->request;
    $result=array();
    $classInfo=null;
    $username = $request->post('ui');
    $classId = $request->post('classid');

    $longitude = $request->post('longitude');
    $latitude = $request->post('latitude');
    
    if($longitude==null||floatval($longitude)<0||$latitude==null||floatval($latitude)<0){
      $result=array(
        'code'=>1006,
        'msg'=>'定位信息错误，无法发起签到',
        'data'=>false,
      );
    }

    if($classId==null){
      $result=array(
          'code'=>1005,
          'msg'=>'课程id错误，无法签到',
          'data'=>false,
        );
    }
    else{
      $classInfo = ClassTable::findOne($classId);
      if($classInfo==null){
        $result=array(
          'code'=>1005,
          'msg'=>'课程id错误，无法签到',
          'data'=>false,
        );
      }
      else if(strtotime($classInfo->SignTime)<strtotime(date('Y-m-d H:i:s', strtotime('-'.$classInfo->Duration.'minute')))) {
        $result=array(
          'code'=>1006,
          'msg'=>'签到时间已过，无法签到',
          'data'=>false,
        );
      }
    }
    if($result!=null&&$result['code']>0){
    }
    else{
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
        

        $CheckinModel = new CheckIn();
        $searchdate=date("Y-m-d H");
        $chklist= $CheckinModel::find()->where(['UserId' => $userinfodetail['UserId'],'ClassId' => $classId])->andWhere(['>','CheckDate',date('Y-m-d H:i:s', strtotime($classInfo->SignTime))])->orderBy('CheckDate desc')->asArray()->all();

        if(count($chklist)>0){
          $result=array(
            'code'=>1003,
            'msg'=>'当前课程已签到，无法再次签到',
            'data'=>false,
          );
        }
        if($result==null)
        {
          $CheckinModel->UserId=$userinfodetail['UserId'];
          $CheckinModel->ClassId=$classId;
          $CheckinModel->CheckDate=date("Y-m-d H:i:s");
          $CheckinModel->CheckState=1;
          $CheckinModel->Longitude = $longitude;
          $CheckinModel->Latitude = $latitude;
          if($CheckinModel->save()){
            $chklist= $CheckinModel::find()->where(['UserId' => $userinfodetail['UserId']])->asArray()->all();
            $result=array(
              'code'=>1,
              'msg'=>'true',
              'data'=>count($chklist)*2,
            );
          }
          else{
            $result=array(
              'code'=>1001,
              'msg'=>'签到失败',
              'data'=>false,
            );
          }
          
        }
      }
      else{
        $result=array(
          'code'=>1002,
          'msg'=>'can`t find this user',
          'data'=>null,
        );
      }
    }
    echo json_encode($result);
  }
  /*
  * 十二、加入班课接口
  */
  public function actionChooseClass(){
    $request = \Yii::$app->request;
    $result=array();
    $username = $request->post('ui');
    $classCode = $request->post('ClassCode');
    $userModel= new User();
    $userList = $userModel::find()->asArray()->all();
    $userinfodetail=null;
    foreach($userList as $user){
      if(md5($user['UserId'])==$username){
        $userinfodetail=$user;
        break;
      }
    }
    $classModel= new ClassTable();
    $classInfo=$classModel::find()->where(['ClassNum' => $classCode])->asArray()->one();
    if($classInfo==null||$classInfo['ClassId']<1){
      $result=array(
        'code'=>1004,
        'msg'=>'课程编码错误',
        'data'=>false,
      );
    }
    else{
      $classId=$classInfo['ClassId'];
      if($userinfodetail!=null){
        $stdModel = new StdClass();
        $stdList=$stdModel::find()->where(['UserId' => $userinfodetail['UserId'],'ClassId' => $classId])->asArray()->all();
        if($stdList!=null){
          $result=array(
            'code'=>1002,
            'msg'=>'已加入当前课程，无需再次加入',
            'data'=>false,
          );
        }
        else{
          $stdModel->UserId=$userinfodetail['UserId'];
          $stdModel->ClassId=$classId;
          if($stdModel->save()){
           
            $result=array(
              'code'=>1,
              'msg'=>'加入成功',
              'data'=>true,
            );
          }
          else{
            $result=array(
              'code'=>1003,
              'msg'=>'加入课程异常',
              'data'=>false,
            );
          }
        }
      }
      else{
        $result=array(
          'code'=>1002,
          'msg'=>'can`t find this user',
          'data'=>null,
        );
      }
    }
    echo json_encode($result);
  }
  /*
  * 十三、发起签到接口
  */
  public function actionStartcheckin(){
    $request = \Yii::$app->request;
    $result=array();
    $username = $request->post('ui');
    $classId = $request->post('classid');

    $longitude = $request->post('longitude');
    $latitude = $request->post('latitude');
    $duration = $request->post('duration');
    if($longitude==null||floatval($longitude)<0||$latitude==null||floatval($latitude)<0){
      $result=array(
        'code'=>1006,
        'msg'=>'定位信息错误，无法发起签到',
        'data'=>false,
      );
    }
    if($duration==null||intval($duration)<1){
      $result=array(
        'code'=>1007,
        'msg'=>'签到时效错误，无法发起签到',
        'data'=>false,
      );
    }


    if($classId==null){
      $result=array(
        'code'=>1005,
        'msg'=>'课程id错误，无法发起签到',
        'data'=>false,
      );
    }
    if($result!=null&&$result['code']>0){

    }
    else{
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
   
          $classInfo = ClassTable::findOne($classId);
          $classInfo->Longitude = $longitude;
          $classInfo->Latitude = $latitude;
          $classInfo->Duration = $duration;
          $classInfo->SignTime = date("Y-m-d H:i:s");
          if($classInfo->update()){
            $result=array(
              'code'=>1,
              'msg'=>'发起签到成功',
              'data'=>true,
            );
          }
          else{
            $result=array(
              'code'=>1001,
              'msg'=>'发起签到失败',
              'data'=>false,
            );
          }
      }
      else{
        $result=array(
          'code'=>1002,
          'msg'=>'can`t find this user',
          'data'=>null,
        );
      }
    }
    echo json_encode($result);
  }
  /*
  * 十四、发起通知接口
  */
  public function actionPostNotice(){
    $request = \Yii::$app->request;
    $userid = $request->post('ui');
    $classid = $request->post('classid');
    $content = $request->post('content');
    $result=array();
    if($content==null){
      $result=array(
        'code'=>1001,
        'msg'=>'content can`t be null',
        'data'=>null,
      );
    }
    $classModel= new ClassTable();
    $classInfo = $classModel::find()->where(['ClassId' => $classid])->asArray()->one();
    $res=array();

    $realId=0;

    if($classInfo!=null){
      if(md5($classInfo['UserId'])==$userid){
        $stdModel = new StdClass();
        $stdList=$stdModel::find()->where(['ClassId' => $classid])->asArray()->all();
        $isSuccess=true;
        foreach($stdList as $classItem){
          $infoModel= new Info();
          $infoModel->ToUserId=$classItem['UserId'];
          $infoModel->FromUserId=$classInfo['UserId'];
          $infoModel->InfoContent=$content;
          $infoModel->InfoType=1;
          $infoModel->ReadType=0;
          $infoModel->InfoDate=date("Y-m-d H:i:s");
          $isSuccess=$isSuccess&&$infoModel->save();
          
        }

        if($isSuccess){
           
            $result=array(
              'code'=>1,
              'msg'=>'通知成功',
              'data'=>true,
            );
          }
          else{
            $result=array(
              'code'=>1004,
              'msg'=>'通知异常',
              'data'=>false,
            );
          }
      }
      else{
        $result=array(
          'code'=>1003,
          'msg'=>'用户与班课不匹配',
          'data'=>null,
        );
      }
    }
    else{
      $result=array(
        'code'=>1002,
        'msg'=>'班课不存在',
        'data'=>null,
      );
    }
  }
}