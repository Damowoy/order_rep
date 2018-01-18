<?php
namespace api\modules\v1\controllers;

use yii\rest\ActiveController;
use yii\filters\AccessControl;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\HttpBearerAuth;
use common\models\User;
use common\models\LoginForm;
use api\modules\v1\models\Comment;

/**
 * Comment Controller API
 *
 *
 */
class CommentController extends ActiveController
{
    public $modelClass = 'api\modules\v1\models\Comment';

    /**
     * @inheritdoc
     */

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
}
