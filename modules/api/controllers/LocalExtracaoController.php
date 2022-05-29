<?php

namespace app\modules\api\controllers;


use app\modules\api\models\LocalExtracaoRest;
use yii\rest\ActiveController;

class LocalExtracaoController extends BaseController
{
    public $modelClass = LocalExtracaoRest::class;

    public function behaviors(){
        $behaviors = parent::behaviors();
        $behaviors['access']['rules'][] = [
            'actions' =>  ['index', 'view', 'create', 'update', 'delete', 'options' ],
            'allow' => true,
            'roles' => ['operario'] // se tirar o role, qualquer utilizar AUTENTICADO pode usar o serviço.
        ];

        return $behaviors;
    }
}