<?php
namespace api\modules\v1\controllers;

use yii;
use common\models\User;
use common\models\ServiceOrder;
use common\models\OrderStdate;


/**
 * Firm Controller API
 *
 * @author Budi Irawan <deerawan@gmail.com>
 */

class ServiceOrderController extends BaseauthController
{
    public $modelClass = '\common\models\ServiceOrder';
    
    public function actions()
    {
        $actions = parent::actions();
        unset($actions['create'], $actions['view']);
        return $actions;
    }
   
    /**
     * @SWG\Get(
     *   path="/profiles",
     *   tags={"order"},
     *   summary="List user role INGENER",
     *   @SWG\Response(
     *     response=200,
     *     description="success"
     *   )
     * )
     *
     **/
    
    /**
     * @param null $id
     * @return array|yii\db\ActiveRecord[]
     * @throws yii\web\ForbiddenHttpException
     */
    public function actionProfiles($id = Null)
    {
        if (Yii::$app->user->identity->role_id == 2) {
            return User::find()->where(['role_id' => 3])->all();
        } else {
            throw new \yii\web\ForbiddenHttpException('invalid user rights (role)!');
        }
    }
    
    /**
     * @SWG\Get(
     *   path="/orders/{id}",
     *   tags={"order"},
     *   summary="List orders",
     *   @SWG\Parameter(
     *        in = "path",
     *        name = "id",
     *        description = "Order id",
     *        required = true,
     *        type = "integer"
     *    ),
     *   @SWG\Response(
     *     response=200,
     *     description="success"
     *   )
     * )
     *
     **/
    /**
     * @SWG\Get(
     *   path="/orders",
     *   tags={"order"},
     *   summary="List orders",
     *   @SWG\Response(
     *     response=200,
     *     description="success"
     *   )
     * )
     *
     **/
    /**
     * @param null $id
     * @return array
     */
    public function actionListOrder($id = Null)
    {
        if (isset($id) && !empty($id)) {
            $model = ServiceOrder::find()->where(['id' => $id])->all();
        } else {
            if (Yii::$app->user->identity->role_id == 2) {
                $model = ServiceOrder::find()->all();
            } else {
                $model = ServiceOrder::find()->where(['user_id' => Yii::$app->user->id])->all();
            }
        }
        $dataOrder = array();
        if ($model) {
            foreach ($model as $val) {
                /** @var User $userArry */
                $userArry = User::findOne(['id' => $val->user_id]);

                /** @var User $managerArry */
                $managerArry = User::findOne(['id' => $val->engener_id]);
                $orderStdateArray = OrderStdate::findOne(['service_order_id' => $val->id]);

                if ($managerArry) {
                    $managerObect = array(
                        'id' => $managerArry->id,
                        'lastname' => $managerArry->lastname,
                        'firstname' => $managerArry->firstname,
                    );
                } else {
                    $managerObect = array();
                }

                $dataOrder[] = array(
                    'name' => array(
                        'id' => $val->id,
                        'title' => $val->name_service
                    ),
                    'user' => array(
                        'id' => $userArry->id,
                        'lastname' => $userArry->lastname,
                        'firstname' => $userArry->firstname,
                    ),
                    'engener' => $managerObect,
                    'status_id' => $val->status_id,
                    'description' => $val->description,
                    'company' => $val->company,
                    'address' => $val->address,
                    'place' => $val->place,
                    'order_stdate' => $orderStdateArray

                );

            }
        }
        return $dataOrder;
    }
    
    /**
     * @SWG\Post(
     *   path="/orders/status",
     *   tags={"order"},
     *   summary="Update status order",
     *   produces = {"application/json"},
     *	 consumes = {"application/json"},
     *   @SWG\Parameter(
     *        in = "formData",
     *        name = "id",
     *        description = "Order id",
     *        required = true,
     *        type = "integer"
     *    ),
     *    @SWG\Parameter(
     *        in = "formData",
     *        name = "status_id",
     *        description = "Status id",
     *        required = true,
     *        type = "integer"
     *    ),
     *     @SWG\Parameter(
     *        in = "formData",
     *        name = "engener_id",
     *        description = "Engener id",
     *        required = true,
     *        type = "integer"
     *    ),
     *   @SWG\Response(
     *     response=200,
     *     description="success",
     *     @SWG\Header(header="Allow", type="POST"),
     *     @SWG\Header(header="Content-Type", type="application/json; charset=UTF-8")
     *   )
     * )
     *
     **/

    /**
     * @return array|void
     * @throws yii\web\ForbiddenHttpException
     */
    public function actionEngenerStatus()
    {
        $request = Yii::$app->request;
        $id         = $request->post('id');
        $status_id  = $request->post('status_id');
        $engener_id = $request->post('engener_id');
       
        /** @var ServiceOrder $order */
        $order = ServiceOrder::findOne(['id' => $id]);
        
        if (!empty($order) && isset($status_id) && !empty($status_id) && isset($id) && !empty($id) && isset($engener_id) && !empty($engener_id)) {
            
                $order->status_id = $status_id;
                $order->engener_id = $engener_id;
                if ($order->save()) {
                    return $this->actionListOrder($id);
                } else {
                    throw new \yii\web\ForbiddenHttpException('Failed update status!');
                }
     
        } else {
            throw new \yii\web\ForbiddenHttpException('Failed fields not!');
        }
    }
    
    /**
     * @SWG\Post(
     *   path="/orders/finisdate",
     *   tags={"order"},
     *   summary="Insert date and status",
     *    @SWG\Parameter(
     *        in = "formData",
     *        name = "order_id",
     *        description = "Order id",
     *        required = true,
     *        type = "integer"
     *    ),
     *     @SWG\Parameter(
     *        in = "formData",
     *        name = "status_id",
     *        description = "Status id",
     *        required = true,
     *        type = "integer"
     *    ),
     *   @SWG\Response(
     *     response=200,
     *     description="success",
     *     @SWG\Header(header="Allow", type="POST"),
     *     @SWG\Header(header="Content-Type", type="application/json; charset=UTF-8")
     *   )
     * )
     *
     **/
    
    /**
     * @throws yii\web\ForbiddenHttpException
     */
    public function actionFinishTime()
    {
        $modelStdate = new OrderStdate();
        $request = Yii::$app->request;
        $status_id = $request->post('status_id');
        $id = $request->post('order_id');
      
        if (isset($status_id) && !empty($status_id) && isset($id) && !empty($id)) {
           
            $modelStdate->status_id = $status_id;
            $modelStdate->service_order_id = $id;
            $modelStdate->created_at = date("Y-m-d H:i:s");
            
            if ($modelStdate->save()) {
                $response = Yii::$app->getResponse();
                $response->setStatusCode(201);
                return $modelStdate;
            } else {
                throw new \yii\web\ForbiddenHttpException('Failed insert time status!');
            }
            
        } else {
            throw new \yii\web\ForbiddenHttpException('Faileds not params!');
        }
    }
    
    /**
     * @SWG\Post(
     *   path="/orders/create",
     *   tags={"order"},
     *   summary="Insert date and status",
     *    @SWG\Parameter(
     *        in = "formData",
     *        name = "name_service",
     *        description = "Name order",
     *        required = true,
     *        type = "string"
     *    ),
     *     @SWG\Parameter(
     *        in = "formData",
     *        name = "description",
     *        description = "Description",
     *        required = true,
     *        type = "string"
     *    ),
     *     @SWG\Parameter(
     *        in = "formData",
     *        name = "company",
     *        description = "Company",
     *        required = true,
     *        type = "string"
     *    ),
     *     @SWG\Parameter(
     *        in = "formData",
     *        name = "place",
     *        description = "Place",
     *        required = true,
     *        type = "string"
     *    ),
     *     @SWG\Parameter(
     *        in = "formData",
     *        name = "address",
     *        description = "Address",
     *        required = true,
     *        type = "string"
     *    ),
     *   @SWG\Response(
     *     response=200,
     *     description="success",
     *     @SWG\Header(header="Allow", type="POST"),
     *     @SWG\Header(header="Content-Type", type="application/json; charset=UTF-8")
     *   )
     * )
     *
     **/
    
    /**
     * @return OrderStdate
     * @throws yii\base\InvalidConfigException
     * @throws yii\web\ForbiddenHttpException
     */
    public function actionCreate()
    {
        $model = new ServiceOrder();
        $model->user_id = Yii::$app->user->id;
        $model->status_id = 1;
        $model->load(Yii::$app->getRequest()->getBodyParams(), '');
        
        if ($model->save()) {

            $response = Yii::$app->getResponse();
            $response->setStatusCode(201);
            $id = implode(',', array_values($model->getPrimaryKey(true)));
            $modelStdate = new OrderStdate();
            $modelStdate->status_id = 1;
            $modelStdate->service_order_id = $id;
            $modelStdate->created_at = date("Y-m-d H:i:s");

            if ($modelStdate->save()) {
                
                return [
                   'order'   => $model,
                   'date_st' => $modelStdate
                ];
                
            } else {
                throw new \yii\web\ForbiddenHttpException('Failed insert time status!');
            }

        } elseif (!$model->hasErrors()) {
            throw new \yii\web\ForbiddenHttpException('Failed to create the object for unknown reason.');
        }
    }
    
}
