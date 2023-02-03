<?php

namespace app\modules\api\controllers;


use app\models\Fotografia;
use app\modules\api\models\FotografiaLoteRest;
use yii\rest\ActiveController;

class FotografiaController extends BaseController
{
    public $modelClass = Fotografia::class;

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