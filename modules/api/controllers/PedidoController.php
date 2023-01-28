<?php

namespace app\modules\api\controllers;


use app\models\Fotografia;
use app\models\FotografiaProduto;
use app\models\Logs;
use app\models\Pedido;
use app\modules\api\models\EstadoPedidoRest;
use app\modules\api\models\MaterialRest;
use app\modules\api\models\PedidoRest;
use app\modules\api\models\UserRest;
use Yii;
use yii\helpers\FileHelper;
use yii\rest\ActiveController;

class PedidoController extends BaseController
{
    public $modelClass = PedidoRest::class;

    public function behaviors(){
        $behaviors = parent::behaviors();
        $behaviors['access']['rules'][] = [
            'actions' =>  ['options', 'find-pedidos-utilizador', 'pedido-orcamento', 'pedido-orcamento-v2'],
            'allow' => true,
            'roles' => ['@'] // se tirar o role, qualquer utilizar AUTENTICADO pode usar o serviço.
        ];
        $behaviors['access']['rules'][] = [
            'actions' =>  ['index', 'view', 'find', 'agendar-recolha-options'],
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

    public static function actionPedidoOrcamentoV2(){
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
        } else {
            return "ERRO";
        }

        $count = 0;
        FileHelper::createDirectory('uploads/users/' . $user->id . '/', 0775);

        foreach ($_FILES as $file){

            if($file["type"] === "image/jpeg"){
                if(move_uploaded_file($file["tmp_name"], "uploads/users/" . $user->id . "/" . "image" . $count . ".jpeg")){
                    $fotografiaId = Fotografia::registrarFotografia("lotes/" . $user->id . "/" . "image" . $count . ".jpeg");
                    $fotografiaModel = Fotografia::findOne(["id" => $fotografiaId]);
                    $modelPedido->anexos[$count] = $fotografiaModel->link;

                }
                $count+=1;
            } elseif ($file["type"] === "image/jpg"){
                if(move_uploaded_file($file["tmp_name"], "uploads/users/" . $user->id . "/" . "image" . $count . ".jpg")){
                    $fotografiaId = Fotografia::registrarFotografia("users/" . $user->id . "/" . "image" . $count . ".jpg");
                    $fotografiaModel = Fotografia::findOne(["id" => $fotografiaId]);
                    $modelPedido->anexos[$count] = $fotografiaModel->link;
                }
                $count+=1;
            } elseif ($file["type"] === "image/png"){
                if(move_uploaded_file($file["tmp_name"], "uploads/users/" . $user->id . "/" . "image" . $count . ".png")){
                    $fotografiaId = Fotografia::registrarFotografia("users/" . $user->id . "/" . "image" . $count . ".png");
                    $fotografiaModel = Fotografia::findOne(["id" => $fotografiaId]);
                    $modelPedido->anexos[$count] = $fotografiaModel->link;
                }
                $count+=1;
            } else {return "Apenas aceitamos imagens do tipo JPG, JPeG ou PNG";}


        }

        Logs::registrarLogUser($user->id, 2, "O usuário de ID " . $user->id . " adidicionou um(uns) anexo(s).");

        return $modelPedido;
    }
}