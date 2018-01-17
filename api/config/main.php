<?php

$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-api',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'modules' => [
        'v1' => [
            'basePath' => '@app/modules/v1',
            'class' => 'api\modules\v1\Module'
        ]
    ],
    'components' => [
         'request' => [
              'parsers' => [
                  'application/json' => 'yii\web\JsonParser',
              ]
        ],
       'response'=>[
          "format" => 'json'
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => false,
            'enableSession' => false,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'enableStrictParsing' => true,
            'showScriptName' => false,
            'rules' => [

                    //'class'         => 'yii\rest\UrlRule',
                    ''                  =>'v1/user/index',
                    'auth'              =>'v1/user/login',
                    'yyy/<id:\d+>'      =>'v1/user/tm',
                   // 'GET profile'       =>'profile/index',
                   // 'PUT,PATCH profile' =>'profile/update',
                    [
                        'class' => 'yii\rest\UrlRule',
                        'controller' =>
                            [
                                'user'         =>'v1/user',
                                'user/<id:\d+>'=>'v1/user/view',
                                'firm'         =>'v1/firm',
                                'serviceorder' =>'v1/service-order',
                                'comment'      =>'v1/comment'
                            ]
                    ],
                    //'controller'    => ['user'=>'v1/user','yyy'=>'v1/user/tm','firm'=>'v1/firm'],//,'v1/user/view','v1/user/login','v1/firm'
                    //'yyy'          => 'v1/user/tm', //user/<id:\d+>
                    ///<id:\d+>
                    //'except' => ['delete'],// исключить
                   // 'tokens'     => ['{id}'   => '<id:\\w+>'],
                    /*'extraPatterns' => [
                        'PUT,PATCH users/<id>' => 'user/update',
                        'DELETE users/<id>' => 'user/delete',
                        'GET,HEAD users/<id>' => 'user/view',
                        'POST users' => 'user/create',
                        'GET,HEAD users' => 'user/index',
                        'users/<id>' => 'user/options',
                        'users' => 'user/options',
                    ],*/
                    //'pluralize' => false



              //  ['class' => 'yii\rest\UrlRule', 'controller' => ''],


               /* 'rules' => [
                    [
                     'class' => 'yii\rest\UrlRule',
                     'controller' => ['v1/post', 'v1/comment', 'v2/post']],
                    'OPTIONS v1/user/login' => 'v1/user/login',
                    'POST v1/user/login' => 'v1/user/login',
                    'POST v2/user/login' => 'v2/user/login',
                    'OPTIONS v2/user/login' => 'v2/user/login',
                ],*/
            ],
        ],

    ],

    'params' => $params,
];



