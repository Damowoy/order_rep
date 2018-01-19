<?php
namespace api\modules\v1\controllers;

use yii;
use common\models\User;
use api\modules\v1\models\ServiceOrder;
use api\modules\v1\models\OrderStdate;


/**
 * Firm Controller API
 *
 * @author Budi Irawan <deerawan@gmail.com>
 */
class ServiceOrderController extends BaseauthController
{
    public $modelClass = 'api\modules\v1\models\ServiceOrder';

    public function actions()
    {
        $actions = parent::actions();
        unset($actions['create'], $actions['view']);
        $actions['index']['prepareDataProvider'] = [$this, 'prepareDataProvider'];
        //unset($actions['index'], $actions['delete'], $actions['create'], $actions['update'], $actions['options']);

        return $actions;
    }

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

            throw new \yii\web\ForbiddenHttpException('Not permission!');
        }
    }

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
     * @return array|void
     * @throws yii\web\ForbiddenHttpException
     */
    public function actionEngenerStatus()
    {
        $request = Yii::$app->request;
        $status_id = $request->post('status_id');
        $id = $request->post('id');
        $engener_id = $request->post('engener_id');

        if (isset($status_id) && !empty($status_id) && isset($id) && !empty($id) && isset($engener_id) && !empty($engener_id)) {

            /** @var ServiceOrder $order */
            $order = ServiceOrder::findOne(['id' => $id]);
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

            } else {
                throw new \yii\web\ForbiddenHttpException('Failed insert time status!');
            }

        } else {
            throw new \yii\web\ForbiddenHttpException('Faileds not params!');
        }

        return $modelStdate;

    }

    public function actionCreate()
    {
        $model = new ServiceOrder();


        //   echo Yii::$app->user->id.'ssssssss';
        // exit();
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
            } else {
                throw new \yii\web\ForbiddenHttpException('Failed insert time status!');
            }

            // $response->getHeaders()->set('Location', Url::toRoute(['view', 'id' => $id], true));
        } elseif (!$model->hasErrors()) {
            throw new \yii\web\ForbiddenHttpException('Failed to create the object for unknown reason.');
        }
        return $model;
    }

    public function prepareDataProvider()
    {
        //$searchModel = new PostSearch();
        return '';//$searchModel->search(Yii::$app->request->queryParams);
    }

    //   public $checkAccessToActions   = ['index','view','update','delete'];

    /**
     * @param string $action
     * @param yii\db\ActiveRecord $model
     * @param array $params
     * @throws yii\web\ForbiddenHttpException
     */
    public function checkAccess($action, $model = null, $params = [])
    {

        if (in_array($action, ['index', 'view', 'update', 'delete'])) {

            if (Yii::$app->user->can('supplier') === false
                or Yii::$app->user->identity->supplierID === null
                or $model->supplierID !== \Yii::$app->user->identity->supplierID
            ) {
                throw new \yii\web\ForbiddenHttpException('You can\'t ' . $action . ' this product.');
            }


            /*if (!Yii::$app->user->can(Rbac::MANAGE_POST, ['post' => $model])) {
                throw  new ForbiddenHttpException('Forbidden.');
            }*/

        }
    }
}
