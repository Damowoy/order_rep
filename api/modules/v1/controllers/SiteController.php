<?php
namespace api\modules\v1\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\HttpBearerAuth;

/**
 * Site controller
 */
class SiteController extends Controller
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
   
        ];
    }
    /**
     * @return array
     */
    public function actions()
    {
        ///var/www/order_rep/api/modules/v1/swagger
        /**
         *
         */
        return [
            /*'error' => [
                'class' => 'yii\web\ErrorAction',
            ],*/
            'docs' => [
                'class' => 'light\swagger\SwaggerAction',
                'restUrl' =>  \yii\helpers\Url::to(['/site/json-schema'], true) ,
                
            ],
            'json-schema' => [
                'class' => 'light\swagger\SwaggerApiAction',
                //The scan directories, you should use real path there.
                'scanDir' => [
                //    Yii::getAlias('@api/modules/v1/swagger'),
                    Yii::getAlias('@api/modules/v1/controllers'),
                    Yii::getAlias('@api/modules/v1/models'),
                    Yii::getAlias('@common/models'),
                 //   Yii::getAlias('@common/models/'),
                 //   Yii::getAlias('@api/modules/v1/module'),
                ],
                'cache' => 'cache',
                'cacheKey' => 'api-swagger-cache', // default is 'api-swagger-cache'
            //    'api_key' => 'xNHPZ7v-nZl5vven9A8E0kiypIbtJ5H4',//xNHPZ7v-nZl5vven9A8E0kiypIbtJ5H4
            ],
        ];
    }
    
  /*  public function actionApi()
    {
      return [
            'action' => $this->action->id,
            'items' => [],
        ];
    }*/
    
    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
       /// return $this->render('index');
        return '';
    }
 
}


