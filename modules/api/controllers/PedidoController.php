<?php

namespace app\modules\api\controllers;


use app\modules\api\models\EstadoPedidoRest;
use app\modules\api\models\MaterialRest;
use app\modules\api\models\PedidoRest;
use app\modules\api\models\UserRest;
use Yii;
use yii\rest\ActiveController;

class PedidoController extends BaseController
{
    public $modelClass = PedidoRest::class;

    public function behaviors(){
        $behaviors = parent::behaviors();
        $behaviors['access']['rules'][] = [
            'actions' =>  ['index', 'view', 'options', 'find-pedidos-utilizador'],
            'allow' => true,
            'roles' => ['operario'] // se tirar o role, qualquer utilizar AUTENTICADO pode usar o serviço.
        ];
        $behaviors['access']['rules'][] = [
            'actions' =>  ['create', 'update', 'delete', 'add'],
            'allow' => true,
            'roles' => ['gestor'] // se tirar o role, qualquer utilizar AUTENTICADO pode usar o serviço.
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

    public function actionFindPedidosUtilizador(){
        $access_header = Yii::$app->request->headers->get("Authorization");
        $access_token = str_replace("Basic ", "", $access_header);
        $access_token = base64_decode($access_token);
        $access_token = str_replace(":", "", $access_token);
        $user = UserRest::findOne(["access_token"=>$access_token]);

        $model = PedidoRest::find()->where(['idUser'=>$user->id])->all();
        return $model;
    }
}