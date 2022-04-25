<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],

    'timeZone' => 'Europe/London',

    'components' => [

        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'lVZtY6X1loBW9EuIRX6PAcqKCQtUpXJI',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        /*
        'user' => [
            'identityClass' => 'app\models\Utilizador',
            'enableAutoLogin' => true,
        ],
        */
        'user' => [
            'class' => 'amnah\yii2\user\components\User',
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        /*
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure transport
            // for the mailer to send real emails.
            'useFileTransport' => false,
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'encryption' => 'tls',
                'host' => 'smtp.gmail.com',
                'port' => '587',
                'username' => 'gestorapedreira@gmail.com',
                'password' => 'CTeSP-DS-Grupo03',
            ],        
        ],
        */
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure transport
            // for the mailer to send real emails.
            'useFileTransport' => false,
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'encryption' => 'tls',
                'host' => 'smtp.gmail.com',
                'port' => '587',
                'username' => 'gestorapedreira@gmail.com',
                'password' => 'CTeSP_DS_Grupo03',
            ],        
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
        'db' => $db,

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                'loja/produto/<id:\d+>' => 'loja/produto',
                'dashboard/encomendas/<id:\d+>' => 'dashboard/encomendas-action',
                'dashboard/encomendas/<id:\d+>/mobilizacao' => 'dashboard/encomendas-mobilizacao',
                'dashboard/encomendas/<idEncomenda:\d+>/cancelar' => 'dashboard/cancelar-encomenda',
                'dashboard/encomendas/<idEncomenda:\d+>/agendar-recolha' => 'dashboard/encomendas-agendar',
                'dashboard/encomendas/<id:\d+>/step' => 'dashboard/encomendas-next-step',
                'dashboard/encomendas/<idEncomenda:\d+>/mobilizacao/confirmar-recolha/<idRecolha:\d+>' => 'dashboard/confirmar-recolha',
                'dashboard/lotes/<codigo_lote:\w+>' => 'dashboard/lotes-action',
            ],
        ],
        'formatter' => [
            'decimalSeparator' => ',',
            'thousandSeparator' => ' ',
            'currencyCode' => '€',
        ],
    ],
    /* added because of amnah/yii2-user */
    'modules' => [
        'user' => [
            'class' => 'amnah\yii2\user\Module',
            // set custom module properties here ...
            'requireEmail' => true,
            'requireUsername' => true,
            'modelClasses' => [
                'Role' => 'app\models\Role',
		'User' => 'app\models\User',
            ]
        ],
    ],
    /* ^ added because of amnah/yii-user ^ */

    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
