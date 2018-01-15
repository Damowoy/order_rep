<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\SignupForm;
use frontend\models\BidForm;
use app\models\ServiceOrder;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
/**
 * Site controller
 */
class AccountController extends Controller
{

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $urlAdd=Url::toRoute('account/add');

        return $this->render('index',['urlAdd' => $urlAdd]);
    }

    /**
     * Displays account page.
     *
     * @return mixed
     */
    public function actionAccount()
    {


        return $this->render('account');
    }


    /**
     * Displays account page.
     *
     * @return mixed
     */
    public function actionAdd()
    {

        $model = new BidForm();
        $modelOrder = new ServiceOrder();

       /* $status = new Status();
        $status = $status::find()->all();*/

        $statusList = Yii::$app->db->createCommand('SELECT * FROM status')->queryAll();
        $statusList=ArrayHelper::map($statusList,'id', 'name');


        if ($model->load(Yii::$app->request->post()) && $model->validate()) {




            $modelOrder->name_service=$model->name_service;
            $modelOrder->description =$model->description;
            $modelOrder->company     =$model->company;
            $modelOrder->place       =$model->place;
            $modelOrder->address     =$model->address;
            $modelOrder->status_id   =$model->status_id;
            $modelOrder->user_id     =$model->user_id;
            $modelOrder->save();


           /* echo "<pre>";
            print_r(Yii::$app->request->post());
            exit();*/
            //   $data=Yii::$app->request->post();

            // echo "<br>".$model->name;

              // $modelOrder->load($model);
               //$modelOrder->name = ;
           /* if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();*///

              //  return $this->redirect(['account']);

            return $this->render('add', [
                'model'   => $model,
                'statusList'  => $statusList
            ]);

        }else {
            return $this->render('add', [
                'model'   => $model,
                'statusList'  => $statusList
            ]);
        }
    }



}


