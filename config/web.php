<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'u_keToHwbTzPuaOzUCHjC04jqEsfvJZx',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
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
        'mongodb' => require(__DIR__ . '/db.php'),
        'db' => [
            'class' =>'yii\db\Connection',
            'dsn' => 'pgsql:host=192.168.10.30;port=5432;dbname=postgis',   
            'emulatePrepare'  => true,
            'enableProfiling' => true,
            'enableParamLogging'=>true,
            'username' => 'postgres',
            'password' => 'postgres',
            'charset' => 'utf8',
        ],
        'urlManager' => [
                'enablePrettyUrl' => true,
                'showScriptName' => false,
                //'enableStrictParsing' => true,
                //'baseUrl' => 'site/index',
                'rules' => [
                    ''=>'site/index',
                    'users'=>'users/index',
                    'category'=>'category/index',
                    'company'=>'company/index',
                    'company/list'=>'company/list',
                    'trademark' => 'trade-mark/index'
                    //'debug/<controller>/<action>' => 'debug/<controller>/<action>',

                ],
            ],
        'authManager' => [
            'class' => 'yii\rbac\PhpManager',
            'defaultRoles' => ['root', 'admin', 'moderator', 'user', 'guest'],
            'itemFile' => '@app/rbac/items.php',
            'assignmentFile' => '@app/rbac/assignments.php',
            'ruleFile' => '@app/rbac/rules.php'
        ],
    ],
    'params' => $params,
    'modules' => [
        'dynagrid'=>[
        'class'=>'\kartik\dynagrid\Module',
        // other settings (refer documentation)
        ],
        'gridview'=>[
            'class'=>'\kartik\grid\Module',
            // other module settings
        ],
    ],
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = 'yii\debug\Module';

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [ 'class' => 'yii\gii\Module',
        'allowedIPs' => ['127.0.0.1',],
        'generators' => [
            'mongoDbModel' => [
            'class' => 'yii\mongodb\gii\model\Generator'
            ]
        ],
    
    ];
}

return $config;
