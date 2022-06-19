<?php

namespace app\modules\api\controllers;

use yii\filters\AccessControl;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\rest\ActiveController;
use yii\web\ForbiddenHttpException;

class BaseController extends ActiveController
{
    public function behaviors()
    {

        $behaviors = parent::behaviors();


        //$auth = $behaviors['authenticator'];
        unset($behaviors['authenticator']);

        $behaviors['corsFilter'] = [
            'class' => \yii\filters\Cors::class,
            'cors' => [
                // restrict access to
                //'Origin' => ['http://localhost:3000', 'https://localhost:3000'],
                'Origin' => ['*'],

                // Allow only POST and PUT methods
                'Access-Control-Request-Method' => ['GET', 'POST', 'PUT', 'OPTIONS', 'DELETE'],
                // Allow only headers 'X-Wsse'
                //'Access-Control-Request-Headers' => ['X-Wsse'],
                'Access-Control-Request-Headers' => ['*'],


                // Allow credentials (cookies, authorization headers, etc.) to be exposed to the browser
                ////'Access-Control-Allow-Credentials' => true,
                // Allow OPTIONS caching
                ////'Access-Control-Max-Age' => 3600,
                // Allow the X-Pagination-Current-Page header to be exposed to the browser.
                'Access-Control-Expose-Headers' => ['X-Pagination-Current-Page', 'X-Pagination-Page-Count', 'X-Pagination-Per-Page'],
            ],
        ];

        //$behaviors['authenticator'] = $auth;
        $behaviors['authenticator'] = [

            'class' => CompositeAuth::class,
            'authMethods' => [
                HttpBasicAuth::class,
                HttpBearerAuth::class //mecanismo de autenticação que o JWT vai utilizar
            ]
        ];


        $behaviors['authenticator']['except'] = ['options'];

        $behaviors['access'] = [
            'class' => AccessControl::className(),
            'rules' => [
                /*[
                    'actions' => ['home', 'index', 'lotes', 'novo-lote', 'lotes-action', 'update-lote', 'delete-lote', 'stock',
                        'produtos', 'novo-produto', 'materiais', 'novo-material', 'cores', 'nova-cor', 'encomendas', 'encomendas-action',
                        'encomendas-mobilizacao', 'encomendas-agendar', 'confirmar-recolha'],
                    'allow' => true,
                    'roles' => ['operario'],
                ],*/
            ],
            'denyCallback' => function ($rule, $action) {
                throw new ForbiddenHttpException("You're not allowed to access");
            }];

        return $behaviors;

    }
}