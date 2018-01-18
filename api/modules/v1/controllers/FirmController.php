<?php
namespace api\modules\v1\controllers;


use yii\rest\ActiveController;
use yii\filters\auth\HttpBasicAuth;
use yii\helpers\ArrayHelper;
use yii\base\NotSupportedException;
use yii\web\Response;
use yii\filters\ContentNegotiator;
//use app\api\modules\v1\models\Firm;

/**
 * Firm Controller API
 *
 * @author Budi Irawan <deerawan@gmail.com>
 */
class FirmController extends ActiveController
{
    public $modelClass = 'api\modules\v1\models\Firm';

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

    /**
     * @inheritdoc
     */

   /* public function behaviors()
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

    /*public function behaviors(): array
    {
        return array_merge(parent::behaviors(), [
            'authenticator' => [
                'class' => HttpBearerAuth::className(),
            ],
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => [User::ROLE_API],
                    ],
                ],
            ],
            'verbFilter' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    '*' => ['post'],
                ],
            ]
        ]);
    }*/

   /* public function actionCreateStudent()

    {

        \Yii::$app->response->format = \yii\web\Response:: FORMAT_JSON;

        $firm = new Firm();

        $firm->scenario = Firm:: SCENARIO_CREATE;

        $firm->attributes = \yii::$app->request->post();


        if($firm->validate())

        {

            $firm->save();

            return array('status' => true, 'data'=> 'Student record is successfully updated');

        }

        else

        {

            return array('status'=>false,'data'=>$firm->getErrors());

        }

    }*/

   /* public function actionGetStudent()

    {

        \Yii::$app->response->format = \yii\web\Response:: FORMAT_JSON;

        $firm = Firm::find()->all();

        if(count($firm) > 0 )

        {

            return array('status' => true, 'data'=> $firm);

        }

        else

        {

            return array('status'=>false,'data'=> 'No Student Found');

        }

    }*/

 /*  public function actionFirm(){
        echo "testado";
    }
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['auth_key' => $token]);
    }*/

}
