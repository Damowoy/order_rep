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
              ],
        ],
       'response'=>[
          "format" => 'json'
        ],
        'user' => [
            'identityClass'   => 'common\models\User',
            'enableAutoLogin' => false,
            'enableSession'   => false,
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
                 'docs'                   =>'v1/site/docs',
                 'site/json-schema'       =>'v1/site/json-schema',
                 'doc'                    =>'v1/site/doc',
                 'POST auth'              =>'v1/user/login',
                 'user/<id:\d+>'          =>'v1/user/view',
                 'GET, orders'            =>'v1/service-order/list-order',
                 'GET orders/<id:\d+>'    =>'v1/service-order/list-order',
                 'GET profiles'           =>'v1/service-order/profiles',
                 'POST orders/status'     =>'v1/service-order/engener-status',
                 'POST orders/finisdate'  =>'v1/service-order/finish-time',
                 'POST orders/create'     =>'v1/service-order/create',
  
                 
                //  'user/?acces_token=<id>' =>'v1/user/view',
                   // <controller:\w+>/<action:\w+>/?query=test' => '<controller>/<action>
                   // 'profile/<id:\d+>'      =>'v1/user/view',
                   // 'GET profile'       =>'profile/index',
                   // 'PUT,PATCH profile' =>'profile/update',
                   //'<action>'=>'v1/site/<action>',
                    [
                        'class' => 'yii\rest\UrlRule',
                        'controller' =>
                            [
                                'user'         =>'v1/user',
                                'firm'         =>'v1/firm',
                                'orders'       =>'v1/service-order',
                                'comments'     =>'v1/comment',
                                'times'        =>'v1/order-stdate',
                                
                            ],
                    ],
       // //(?P<id>\d+)
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
       /* 'urlManagerBackend' => [
            'class' => 'yii\web\urlManager',
            'baseUrl' => 'http://orderrep/',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                'http://api.orderrep/' =>'site/api',
            ]
        ],*/
    ],

    'params' => $params,
];



