<?php
namespace api\modules\v1\controllers;


use Yii;
use yii\rest\ActiveController;
use yii\rest\Controller;
use yii\filters\AccessControl;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\base\NotSupportedException;
use yii\web\Response;
use yii\filters\ContentNegotiator;
use api\modules\v1\models\User;
use api\modules\v1\models\LoginForm;
use api\modules\v1\models\Token;

/**
 * User Controller API
 *
 * @author Budi Irawan <deerawan@gmail.com>
 */
//yii\rest\Controller
//yii\rest\ActiveController

class UserController extends Controller // /  ActiveController
{
    public $modelClass = 'api\modules\v1\models\User';
    /**
     * @inheritdoc
     */

    public function actionLogin()
    {
        $model = new LoginForm();
        $model->load(Yii::$app->request->bodyParams, '');
        if ($token = $model->auth()) {
            return $token;
        } else {
            return $model;
        }
    }

    public function actionView($id)
    {
        $token= Token::findOne([
            'token' => $id
        ]);

        return $token;
      // exit();
      //  return User::findOne($id);
    }

    public function checkAccess($action, $model = null, $params = [])
    {
        if (in_array($action, ['update', 'delete', 'create', 'index'])) {//
            if (!Yii::$app->user->can(Rbac::MANAGE_POST, ['post' => $model])) {
                throw  new ForbiddenHttpException('Forbidden.');
            }
        }
    }

    protected function verbs()
    {
        return [
            'login' => ['post'],

        ];
    }


    /*   public function behaviors()
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
   }*/
    /*public function actionIndex()
    {

        return "api";
    }
      public function actionTm($id)
      {
          echo $id;
          exit();
          return User::findOne($id);
      }*/
/*

    public function actionView($id)
    {
    return User::findOne($id);
    }
*
*/

   /* protected function verbs()
    {
        return [
            'login' => ['post'],
        ];
    }*/



/*
GET /users: list all users page by page;
HEAD /users: show the overview information of user listing;
POST /users: create a new user;
GET /users/123: return the details of the user 123;
HEAD /users/123: show the overview information of user 123;
PATCH /users/123 and PUT /users/123: update the user 123;
DELETE /users/123: delete the user 123;
OPTIONS /users: show the supported verbs regarding endpoint /users;
OPTIONS /users/123: show the supported verbs regarding endpoint /users/123.
    */

   /* public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => HttpBasicAuth::className(),
        ];
        return $behaviors;
    }*/



   /* public function actions()
    {
        $actions = parent::actions();

         echo "<pre>";
        print_r($actions);
        exit();
        // отключить действия "delete" и "create"
        unset($actions['delete'], $actions['create']);

        // настроить подготовку провайдера данных с помощью метода "prepareDataProvider()"
        $actions['index']['prepareDataProvider'] = [$this, 'prepareDataProvider'];

        return $actions;
    }*/
   /* public function checkAccess($action, $model = null, $params = [])
    {
        // проверить, имеет ли пользователь доступ к $action и $model
        // выбросить ForbiddenHttpException, если доступ следует запретить
        if ($action === 'update' || $action === 'delete') {
            if ($model->author_id !== \Yii::$app->user->id)
                throw new \yii\web\ForbiddenHttpException(sprintf('You can only %s articles that you\'ve created.', $action));
        }
    }*/


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
