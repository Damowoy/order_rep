<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);



return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
      
        'request' => [
            'csrfParam' => '_csrf-frontend',
            'baseUrl'   => '',
            'cookieValidationKey' => 'SVnVkT24CuHMpvpvZkiANzL6jR8xSNb0',
             'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ],
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
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
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        
        'urlManager' => [
            'enablePrettyUrl' => true,
            'enableStrictParsing' => true,
            'showScriptName' => false,
            'rules' => [
    
                ''                     => 'site/index',
                'doc'                  => 'site/doc',
             //   'api'                  => 'site/api',
                /*    [
                        'class' => 'yii\rest\UrlRule',
                        'controller' => ['/api/modules/v1/user'],
                        'extraPatterns' => [
                            'POST query' => 'query'
                        ]
                    ],*/
                //W'<action>'=>'site/<action>',

                
               /* 'docs' => 'site/docs',
                [
                    'pattern' => 'resource',
                    'route'   => 'site/resource',
                    'suffix'  => '.json'
                ],
                [
                    'class' => 'yii\rest\UrlRule',
                    'pluralize' => false,
                    'prefix' => 'api',
                    'controller' => ['v1'],
                    'extraPatterns' => $rules,
                ],*/
                
            ],
        ],
        
        
    ],
    'params' => $params,
];
