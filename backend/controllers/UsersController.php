<?php

namespace backend\controllers;

use Yii;
use backend\models\Users;
use backend\models\UsersSearch;
use backend\models\Roles;
use backend\models\Firms;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

/**
 * UsersController implements the CRUD actions for Users model.
 */
class UsersController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Users models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UsersSearch();

        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);


       // $dataProvider = $dataProvider::find()->select('user.*,role.name as namerole')->leftJoin('role', 'user.role_id=role.id')->all();

        /*  $customers = Customer::find()
              ->select('customer.*')
              ->leftJoin('order', '`order`.`customer_id` = `customer`.`id`')
              ->where(['order.status' => Order::STATUS_ACTIVE])
              ->with('orders')
              ->all();*/

       //

  //   //   $dataProvider->findone(1)->roles,
       /* $customer = $searchModel::findOne(1);
        $orders = $customer->roles;*/

      //  $searchModel->link('roles', $searchModel->roles);
      //
       // $customers = ;
        //$searchModel::find()->all()
      /*  echo "<pre>";
        print_r($customers);
        exit();*/

       /* $result=$searchModel::find()->with('roles')->all();
        $dataResult=array();
        foreach ($result as $val) {
            $dataResult[]=array(
                'id'        => $val->id,
                'username'  => $val->username,
                'email'     => $val->email,
                'phone'     => $val->phone,
                'lastname'  => $val->lastname,
                'firstname' => $val->firstname,
                'role_id'   => $val->role_id,
                'name_role' => $val->roles[0]->name
            );
        }*/


        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Users model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Users model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Users();
        $modelRoles = new Roles();
        $modelFirms = new Firms();
        $listRoles = $modelRoles::find()->all();
        $listRoles=ArrayHelper::map($listRoles,'id', 'name');

        $listFirm = $modelFirms::find()->all();
        $listFirm=ArrayHelper::map($listFirm,'id', 'name');

        if ($model->load(Yii::$app->request->post())) {

            $model->password_hash=Yii::$app->security->generatePasswordHash($model->password_hash);
            $model->status=10;
            $model->save();

            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model'     => $model,
                'listRoles' => $listRoles,
                'listFirm' => $listFirm
            ]);
        }
    }

    /**
     * Updates an existing Users model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $modelRoles = new Roles();
        $modelFirms = new Firms();
        $listRoles = $modelRoles::find()->all();
        $listRoles=ArrayHelper::map($listRoles,'id', 'name');

        $listFirm = $modelFirms::find()->all();
        $listFirm=ArrayHelper::map($listFirm,'id', 'name');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model'    => $model,
                'listRoles'=> $listRoles,
                'listFirm' => $listFirm
            ]);
        }
    }

    /**
     * Deletes an existing Users model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Users model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Users the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Users::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
