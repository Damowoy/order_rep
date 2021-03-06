<?php
namespace api\modules\v1\controllers;

use Yii;
use yii\rest\Controller;
use common\models\LoginForm;
use common\models\User;


/**
 * User Controller API
 *
 * @author Budi Irawan <deerawan@gmail.com>
 */

class UserController extends Controller
{
    public $modelClass = '\common\models\User';
    /**
     * @return array
     */
    public static function allowedDomains()
    {
        return [
            '*'
        ];
    }
    
    /**
     * @return array
     */
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        
        $behaviors['corsFilter'] = [
            'class' => \yii\filters\Cors::className(),
            'cors' => [
                'Origin' => static::allowedDomains(),
                'Access-Control-Request-Method' => ['POST', 'GET', 'PUT', 'DELETE', 'OPTIONS'],
                'Access-Control-Allow-Credentials' => true,
                'Access-Control-Max-Age' => 3600,
                'Access-Control-Request-Headers' => ['*'],
            ],
        ];
        return $behaviors;
    }
    /**
     * @SWG\Post(
     *   path="/auth",
     *   tags={"user"},
     *   summary="Authorization",
     *   produces = {"application/json"},
     *	 consumes = {"application/json"},
     *   @SWG\Parameter(
     *        in = "formData",
     *        name = "username",
     *        description = "nikname",
     *        required = true,
     *        type = "string"
     *     ),
     *     @SWG\Parameter(
     *        in = "formData",
     *        name = "password",
     *        description = "pass",
     *        required = true,
     *        type = "string"
     *     ),
     *   @SWG\Response(
     *     response=200,
     *     description="success",
     *     @SWG\Header(header="Allow", type="POST"),
     *     @SWG\Header(header="Content-Type", type="application/json; charset=UTF-8")
     *   )
     *
     * )
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
    /**
     * @SWG\Get(
     *   path="/user/{id}",
     *   tags={"user"},
     *   summary="User id",
     *   @SWG\Response(
     *     response=200,
     *     description="success"
     *   ),
     *   @SWG\Parameter(
     *        in = "path",
     *        name = "id",
     *        description = "User id",
     *        required = true,
     *        type = "integer"
     *    )
     * )
     *
     **/
    
    /**
     * @param $id
     * @return null|static
     */
    public function actionView($id)
    {
        $token= User::findOne([
            'id' => $id
        ]);
        return $token;
    }
    
    /**
     * @return array
     */
    protected function verbs()
    {
        return [
            'login' => ['post'],
        ];
    }
    

}
