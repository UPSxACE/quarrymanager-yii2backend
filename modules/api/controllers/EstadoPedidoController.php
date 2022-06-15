<?php

namespace app\modules\api\controllers;


use app\modules\api\models\EstadoPedidoRest;
use app\modules\api\models\PedidoRest;
use Yii;
use yii\rest\ActiveController;

class EstadoPedidoController extends BaseController
{
    public $modelClass = EstadoPedidoRest::class;

    public function behaviors(){
        $behaviors = parent::behaviors();
        $behaviors['access']['rules'][] = [
            'actions' =>  ['index', 'view', 'create', 'update', 'delete', 'options', 'listar-encomendas', 'ultimos-meses' ],
            'allow' => true,
            'roles' => ['operario'] // se tirar o role, qualquer utilizar AUTENTICADO pode usar o serviço.
        ];

        return $behaviors;
    }

    public function actionListarEncomendas(){
        $model = new EstadoPedidoRest();
        $get = Yii::$app->request->get(); //esta linha de código vai buscar os parâmetros de query do REQUEST (ex: ?grau="licensiatura)
        $dataProvider = $model->dadosListar($get);

        return $dataProvider;

    }

    public function actionUltimosMeses(){
        $model = new EstadoPedidoRest();
        return $model->ultimosSeisMeses();
    }


}