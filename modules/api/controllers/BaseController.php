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

        $behaviors['authenticator'] = [

            'class' => CompositeAuth::class,
            'authMethods' => [
                HttpBasicAuth::class,
                HttpBearerAuth::class //mecanismo de autenticação que o JWT vai utilizar
            ]
        ];

        return $behaviors;

    }
}