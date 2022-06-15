<?php

namespace app\modules\api\controllers;


use app\modules\api\models\EstadoPedidoRest;
use app\modules\api\models\MaterialRest;
use app\modules\api\models\PedidoRest;
use Yii;
use yii\rest\ActiveController;

class PedidoController extends BaseController
{
    public $modelClass = PedidoRest::class;

    public function behaviors(){
        $behaviors = parent::behaviors();
        $behaviors['access']['rules'][] = [
            'actions' =>  ['index', 'view', 'create', 'update', 'delete', 'options', 'add'],
            'allow' => true,
            'roles' => ['operario'] // se tirar o role, qualquer utilizar AUTENTICADO pode usar o serviço.
        ];

        return $behaviors;
    }

    public function actionAdd(){

        $modelPedido = new PedidoRest();
        $modelPedido->load(Yii::$app->request->post(),'');
        $modelPedido->save();

        EstadoPedidoRest::registrarNovoPedido($modelPedido->id);

        return $modelPedido;
    }
}