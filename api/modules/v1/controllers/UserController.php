<?php
namespace api\modules\v1\controllers;

use yii\rest\ActiveController;
use yii\filters\auth\HttpBasicAuth;
use yii\helpers\ArrayHelper;
use yii\base\NotSupportedException;
use yii\web\Response;
use yii\filters\ContentNegotiator;
use api\modules\v1\models\User;

//use common\models\LoginForm;

//use yii\web\Controller;
/**
 * User Controller API
 *
 * @author Budi Irawan <deerawan@gmail.com>
 */
class UserController extends ActiveController
{
    public $modelClass = 'api\modules\v1\models\User';
    /**
     * @inheritdoc
     */


    /*public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }*/

    /**
     * @inheritdoc
     */
    /*  public function actions()
      {
          echo "1";
          exit();
      }*/

   /* public function actionLogin()
    {
        $model = new LoginForm();
        if ($model->load(\Yii::$app->getRequest()->getBodyParams(), '') && $model->login()) {
            return \Yii::$app->user->identity->getAuthKey();
        } else {
            return $model;
        }
    }*/

  /*  public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => HttpBasicAuth::className(),
        ];
        $behaviors['bootstrap'] = [
            'class' => ContentNegotiator::className(),
            'formats' => [
                'application/json' => Response::FORMAT_JSON,
            ],
        ];
        return $behaviors;
    }*/
    /**
     * Displays homepage.
     *
     * @return mixed
     */
     /* public function actionIndex()
      {
          \Yii::$app->response->format = \yii\web\Response:: FORMAT_JSON;
          echo "2";
          $json=array(1,2,3);
          return $json;
      }*/

  /*  public function actionTrr()
    {
        echo "3";
        return "";
    }*/


    /*public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => QueryParamAuth::className(),
        ];
        return $behaviors;
    }*/

}
