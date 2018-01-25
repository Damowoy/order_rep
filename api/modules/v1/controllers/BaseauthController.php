<?php

namespace api\modules\v1\controllers;

use yii\rest\ActiveController;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\AccessControl;

/**
 * Class BaseauthController
 * @package api\modules\v1\controllers
 */
class BaseauthController extends ActiveController
{
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

}