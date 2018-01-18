<?php
namespace api\modules\v1\controllers;

use yii;
use yii\base\Model;
use yii\rest\ActiveController;
use yii\filters\AccessControl;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\HttpBearerAuth;
use common\models\User;
use common\models\LoginForm;
use api\modules\v1\models\ServiceOrder;

/**
 * Firm Controller API
 *
 * @author Budi Irawan <deerawan@gmail.com>
 */
class ServiceOrderController extends ActiveController
{
    public $modelClass = 'api\modules\v1\models\ServiceOrder';


      public function behaviors()
    {
     $behaviors = parent::behaviors();
        $behaviors['authenticator']['authMethods'] = [
            HttpBasicAuth::className(),
            HttpBearerAuth::className(),
        ];
        $behaviors['access'] = [
            'class' => AccessControl::className(),
            'rules' => [
                [
                    'allow' => true,
                    'roles' => ['@'],
                ],
            ],
        ];
        return $behaviors;
    }

    public function ActionAuthenticate(){

        $request = Yii::$app->request;
        $authHeader=$request->getHeaders()->get('authorization');
        print_r($authHeader);
        return '';

    }

    public function actions()
    {

        $actions = parent::actions();
        unset($actions['create'],$actions['view']);
        $actions['index']['prepareDataProvider'] = [$this, 'prepareDataProvider'];
        //unset($actions['index'], $actions['delete'], $actions['create'], $actions['update'], $actions['options']);
        return $actions;
    }

    public function actionListOrder($id,$order_id=Null)
    {  if(!empty($order_id)){
        $model   = ServiceOrder::find()->where(['id' => $order_id])->all();
       }else{
        $model   = ServiceOrder::find()->where(['user_id' => $id])->all();
      }

        $dataOrder=array();
        if($model){
            foreach ($model as $val){
                $userArry =User::findOne(['id'=>$val->user_id]);
                $managerArry =User::findOne(['id'=>$val->engener_id]);
                if($managerArry){
                    $managerObect=array(
                        'id'        => $managerArry->id,
                        'lastname'  => $managerArry->lastname,
                        'firstname' => $managerArry->firstname,
                    );
                }else{
                    $managerObect=array();
                }

                $dataOrder[] = array(
                    'name'   => array (
                                'id'    => $val->id,
                                'title' => $val->name_service
                             ),
                    'user'          => array(
                        'id'        => $userArry->id,
                        'lastname'  => $userArry->lastname,
                        'firstname' => $userArry->firstname,
                    ),
                    'engener'     => $managerObect,
                    'status_id'   => $val->status_id,
                    'description' => $val->description,
                    'company'     => $val->company,
                    'address'     => $val->address,
                    'place'       => $val->place,

                );

            }
        }
        return $dataOrder;
    }
    public function actionEnegerStatus()
    {
        $model = new ServiceOrder();
        $request = Yii::$app->request;
        $status_id=$request->post('status_id');
        $id=$request->post('id');
        $engener_id=$request->post('engener_id');
        if(isset($status_id) &&  $status_id>0 && isset($id) &&  $id>0 && isset($engener_id) &&  $engener_id>0 ){

            $order =ServiceOrder::findOne(['id'=>$id]);
            $order->status_id = $status_id;
            $order->engener_id= $engener_id;
           // print_r($request->post('status_id'));
           // print_r($request->post('id'));
            if ($order->save()) {

                return $this->actionListOrder(Yii::$app->user->id,$id);

            }else{
                throw new \yii\web\ForbiddenHttpException('Failed update status!');
            }

        }else{

            throw new \yii\web\ForbiddenHttpException('Failed fields not!');
        }


          return;
    }
    public function actionCreate()
    {
        $model = new ServiceOrder();
     //   echo Yii::$app->user->id.'ssssssss';
       // exit();
        $model->user_id   = Yii::$app->user->id;
        $model->status_id = 1;
        $model->load(Yii::$app->getRequest()->getBodyParams(), '');
        if ($model->save()) {
            $response = Yii::$app->getResponse();
            $response->setStatusCode(201);
           // $id = implode(',', array_values($model->getPrimaryKey(true)));
           // $response->getHeaders()->set('Location', Url::toRoute(['view', 'id' => $id], true));
        } elseif (!$model->hasErrors()) {
            throw new ServerErrorHttpException('Failed to create the object for unknown reason.');

        }
        return $model;
    }
    public function prepareDataProvider()
    {
        //$searchModel = new PostSearch();
        return 'list orders';//$searchModel->search(Yii::$app->request->queryParams);
    }
 //   public $checkAccessToActions   = ['index','view','update','delete'];

    public function checkAccess($action, $model = null, $params = [])
    {

        if (in_array($action, ['index','view','update', 'delete'])) {

            if ( Yii::$app->user->can('supplier') === false
                or Yii::$app->user->identity->supplierID === null
                or $model->supplierID !== \Yii::$app->user->identity->supplierID )
            {
                throw new \yii\web\ForbiddenHttpException('You can\'t '.$action.' this product.');
            }


            /*if (!Yii::$app->user->can(Rbac::MANAGE_POST, ['post' => $model])) {
                throw  new ForbiddenHttpException('Forbidden.');
            }*/

         }
    }
}
