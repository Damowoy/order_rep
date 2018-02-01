<?php
namespace api\modules\v1\controllers;

use yii;
use common\models\User;
use common\models\ServiceOrder;
use common\models\OrderStdate;
use yii\web\ForbiddenHttpException;


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
            throw new ForbiddenHttpException('invalid user rights (role)!');
        }
    }
    
    /**
     * @SWG\Get(
     *   path="/profile",
     *   tags={"order"},
     *   summary="User data",
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
    public function actionUser($id = Null)
    {
        if (is_null($id)) {
            $id = Yii::$app->user->identity->id;
        }

        return User::findOne([
            'id' => $id
        ]);
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
        if (!is_null($id)) {
            $model = ServiceOrder::find()->where(['id' => $id])->all();
        } else {
            if (Yii::$app->user->identity->role_id == 2) {  # What means this number 2 ?
                $model = ServiceOrder::find()->all();
            } else {
                $model = ServiceOrder::find()->where(['user_id' => Yii::$app->user->id])->all();
            }
        }

        if (!$model) {
            return [];
        }

        $dataOrder = [];
        foreach ($model as $val) {
            /** @var User $user */
            $user = User::findOne(['id' => $val->user_id]);

            /** @var User $manager */
            $manager = User::findOne(['id' => $val->engener_id]);
            $orderStdateArray = OrderStdate::findOne(['service_order_id' => $val->id]);

            $managerArr = [];
            if ($manager) {
                $managerArr = [
                    'id' => $manager->id,
                    'lastname' => $manager->lastname,
                    'firstname' => $manager->firstname,
                ];
            }

            $dataOrder[] = [
                'name' => [
                    'id' => $val->id,
                    'title' => $val->name_service
                ],
                'user' => [
                    'id' => $user->id,
                    'lastname' => $user->lastname,
                    'firstname' => $user->firstname,
                ],
                'engener' => $managerArr,
                'status_id' => $val->status_id,
                'description' => $val->description,
                'company' => $val->company,
                'address' => $val->address,
                'place' => $val->place,
                'order_stdate' => $orderStdateArray
            ];
        }

        return $dataOrder;
    }
    
    /**
     * @SWG\Post(
     *   path="/orders/status",
     *   tags={"order"},
     *   summary="Update status order",
     *   produces = {"application/json"},
     *   consumes = {"application/json"},
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
        $id        = !empty($request->post('id')) ? $request->post('id') : 0;
        $statusId  = !empty($request->post('status_id')) ? $request->post('status_id') : 0;
        $engenerId = !empty($request->post('engener_id')) ? $request->post('engener_id') : 0;
       
        /** @var ServiceOrder $order */
        $order = ServiceOrder::findOne(['id' => $id]);
        
        if (empty($order) || !$statusId || !$id || !$engenerId) {
            throw new ForbiddenHttpException('Failed fields not!');
        }
            
        $order->status_id = $statusId;
        $order->engener_id = $engenerId;
        if (!$order->save()) {
            throw new ForbiddenHttpException('Failed update status!');
        }

        return $this->actionListOrder($id);
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
        $statusId = !empty($request->post('status_id')) ? $request->post('status_id') : 0;
        $id = !empty($request->post('order_id')) ? $request->post('order_id') : 0;
      
        if (!$statusId || !$id) {
            throw new ForbiddenHttpException('Failed not params!');
        }
           
        $modelStdate->status_id = $statusId;
        $modelStdate->service_order_id = $id;
        $modelStdate->created_at = date("Y-m-d H:i:s");

        if (!$modelStdate->save()) {
            throw new ForbiddenHttpException('Failed insert time status!');
        }

        $response = Yii::$app->getResponse();
        $response->setStatusCode(201);

        return $modelStdate;
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
        $model->status_id = 1; # What means this number 1 ?
        $model->load(Yii::$app->getRequest()->getBodyParams(), '');
        
        if (!$model->save()) {
            throw new ForbiddenHttpException('Failed to create the object for unknown reason.');
        }

        $response = Yii::$app->getResponse();
        $response->setStatusCode(201);
        $id = implode(',', array_values($model->getPrimaryKey(true)));
        $modelStdate = new OrderStdate();
        $modelStdate->status_id = 1; # What means this number 1 ?
        $modelStdate->service_order_id = $id;
        $modelStdate->created_at = date("Y-m-d H:i:s");

        if (!$modelStdate->save()) {
            throw new ForbiddenHttpException('Failed insert time status!');
        }

        return [
           'order'   => $model,
           'date_st' => $modelStdate
        ];
    }
}
