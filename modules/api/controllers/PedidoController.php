<?php

namespace app\modules\api\controllers;


use app\models\Logs;
use app\models\Pedido;
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
            'actions' =>  ['index', 'view', 'options', 'find', 'find-pedidos-utilizador', 'agendar-recolha-options', 'pedido-orcamento'],
            'allow' => true,
            'roles' => ['operario'] // se tirar o role, qualquer utilizar AUTENTICADO pode usar o serviço.
        ];
        $behaviors['access']['rules'][] = [
            'actions' =>  ['create', 'update', 'delete', 'add', 'cancelar-encomenda', 'proximo-estado'],
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

    public function actionFind(){
        $model = PedidoRest::find()->where(['id'=>Yii::$app->request->get('id')])->one();
        return $model;
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

    public function actionAgendarRecolhaOptions(){
        $pedido = Pedido::find()->where(["id" => Yii::$app->request->get("idPedido")])->one() ;
        $idProduto = $pedido->idProduto;
        return PedidoRest::agendarRecolhaOptions($idProduto);
    }

    public function actionCancelarEncomenda(){
        $idEncomenda = Yii::$app->request->get("idPedido");
        EstadoPedidoRest::cancelarPedido($idEncomenda);
        return "Encomenda Cancelada";
    }

    public function actionProximoEstado(){
        $idEncomenda = Yii::$app->request->get("idPedido");

        $modelEncomenda = Pedido::find()->where(['id'=>$idEncomenda])->one();
        $estadoAtual = $modelEncomenda->ultimoEstadoId();
        if($estadoAtual < 9){
            $modelEncomenda->nextState($idEncomenda);
            Logs::registrarLogUser(Yii::$app->user->identity->id, 3, "O estado da encomenda #" . $modelEncomenda->id . " foi atualizada.");

        }

        return "Encomenda Atualizada";
    }

    public static function actionPedidoOrcamento(){
        $access_header = Yii::$app->request->headers->get("Authorization");
        $access_token = str_replace("Basic ", "", $access_header);
        $access_token = base64_decode($access_token);
        $access_token = str_replace(":", "", $access_token);
        $user = UserRest::findOne(["access_token"=>$access_token]);

        $modelPedido = new PedidoRest();
        $modelPedido->idUser = $user->id;
        $modelPedido->dataHoraPedido = date('Y-m-d H:i:s');
        $modelPedido->idProduto = Yii::$app->request->post("idProduto");
        if ($modelPedido->load(Yii::$app->request->post(), '') && $modelPedido->save()) {
            $modelEstadoPedido = new EstadoPedidoRest();
            $modelEstadoPedido->idEstado = '1';
            $modelEstadoPedido->idPedido = $modelPedido->id;
            $modelEstadoPedido->dataEstado = $modelPedido->dataHoraPedido;

            $modelEstadoPedido->save();
        }

        return $modelPedido;
    }
}