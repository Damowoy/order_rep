<?php
namespace api\modules\v1\controllers;

use Yii;
use yii\rest\Controller;
use api\modules\v1\models\LoginForm;
use api\modules\v1\models\Token;

/**
 * User Controller API
 *
 * @author Budi Irawan <deerawan@gmail.com>
 */
class UserController extends Controller
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

    protected function verbs()
    {
        return [
            'login' => ['post'],

        ];
    }

}
