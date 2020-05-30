<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\controllers;
use Yii;
use yii\web\Controller;
use app\models\MostopToken;

/**
 * Controller is the base class of web controllers.
 *
 * For more details and usage information on Controller, see the [guide article on controllers](guide:structure-controllers).
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class ApiBaseController extends Controller
{

    /**
     * @var bool whether to enable CSRF validation for the actions in this controller.
     * CSRF validation is enabled only when both this property and [[\yii\web\Request::enableCsrfValidation]] are true.
     */
    public $enableCsrfValidation = false;

    public function beforeAction($action)
    {
        $request = \Yii::$app->request;
        if ($request->isPost) {
            $result=null;
            if(!parent::beforeAction($action))
            {
              $result=array(
                'code'=>9999,
                'msg'=>'前置条件判断失败',
                'data'=>'beforeAction',
              );
              echo json_encode($result);
              //return false;
            }
            //登陆与注册接口不进行token判断
            else if($action->actionMethod=="actionUserLogin"||$action->actionMethod=="actionUserRegister"){
              return true;
            }
            //其他接口进行token判断
            else{
              $usertoken = $request->post('ukey');
              $tokenModel= new MostopToken();
              $utoken=$tokenModel->find()->where(['ukey' => $usertoken])->asArray()->one();
              if($utoken==null)
              {
                $result=array(
                  'code'=>888,
                  'msg'=>'UserKey is Wrong',
                  'data'=>'beforeAction',
                );
              }
              else if(strtotime($utoken['addtime'])<date('Y-m-d H:i:s', strtotime('-1hour')))
              {
                $result=array(
                  'code'=>889,
                  'msg'=>'UserKey is outdate',
                  'data'=>'beforeAction',
                );
                $tokenModel->deleteAll("ukey='".$usertoken."'");
              }
              if($result==null){
                return true;
              }
              else{
                echo json_encode($result);
                return false;
              }
            }
          }
        else{
            $result=array(
              'code'=>1001,
              'msg'=>'please post the request',
              'data'=>'beforeAction',
            );
            echo json_encode($result);
        }
    }
}