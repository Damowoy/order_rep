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

}
