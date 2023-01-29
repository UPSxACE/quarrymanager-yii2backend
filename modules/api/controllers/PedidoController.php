<?php

namespace app\modules\api\controllers;


use app\models\Estado;
use app\models\Fotografia;
use app\models\FotografiaProduto;
use app\models\Logs;
use app\models\Pedido;
use app\models\Produto;
use app\modules\api\models\EstadoPedidoRest;
use app\modules\api\models\MaterialRest;
use app\modules\api\models\PedidoRest;
use app\modules\api\models\ProdutoRest;
use app\modules\api\models\UserRest;
use Yii;
use yii\helpers\FileHelper;
use yii\httpclient\Client;
use yii\rest\ActiveController;
use yii\web\BadRequestHttpException;

class PedidoController extends BaseController
{
    public $modelClass = PedidoRest::class;

    public function behaviors(){
        $behaviors = parent::behaviors();
        $behaviors['access']['rules'][] = [
            'actions' =>  ['options', 'find-pedidos-utilizador', 'pedido-orcamento', 'pedido-orcamento-v2', 'loja-pesquisa'],
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
        $conta_gestores_uid = "GESTORES";

        $access_header = Yii::$app->request->headers->get("Authorization");
        $access_token = str_replace("Basic ", "", $access_header);
        $access_token = base64_decode($access_token);
        $access_token = str_replace(":", "", $access_token);
        $user = UserRest::findOne(["access_token"=>$access_token]);

        $user_uid = Yii::$app->request->post("user_uid");
        $user_name = Yii::$app->request->post("user_name");
        $user_avatar = Yii::$app->request->post("user_avatar");


        $modelPedido = new PedidoRest();


        $modelPedido->idUser = $user->id;
        $modelPedido->dataHoraPedido = date('Y-m-d H:i:s');
        $modelPedido->idProduto = Yii::$app->request->post("idProduto");

        try {
            if(Yii::$app->request->post("quantidade") <= 0){
                throw new BadRequestHttpException;
            }
        } catch (\Exception $e) {
            throw new BadRequestHttpException;
        }


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

        $objeto_resposta = new \stdClass();
        $objeto_resposta->anexos = [];

        foreach ($_FILES as $file){

            if($file["type"] === "image/jpeg"){
                if(move_uploaded_file($file["tmp_name"], "uploads/users/" . $user->id . "/" . hash("md5", "image" . $count) . ".jpeg")){
                    $fotografiaId = Fotografia::registrarFotografia("users/" . $user->id . "/" .  hash("md5", "image" . $count) . ".jpeg");
                    $fotografiaModel = Fotografia::findOne(["id" => $fotografiaId]);
                    $objeto_resposta->anexos[$count] = $fotografiaModel->link;

                }
                $count+=1;
            } elseif ($file["type"] === "image/jpg"){
                if(move_uploaded_file($file["tmp_name"], "uploads/users/" . $user->id . "/" . hash("md5", "image" . $count). ".jpg")){
                    $fotografiaId = Fotografia::registrarFotografia("users/" . $user->id . "/" .  hash("md5", "image" . $count) . ".jpg");
                    $fotografiaModel = Fotografia::findOne(["id" => $fotografiaId]);
                    $objeto_resposta->anexos[$count] = $fotografiaModel->link;
                }
                $count+=1;
            } elseif ($file["type"] === "image/png"){
                if(move_uploaded_file($file["tmp_name"], "uploads/users/" . $user->id . "/" .  hash("md5", "image" . $count) . ".png")){
                    $fotografiaId = Fotografia::registrarFotografia("users/" . $user->id . "/" .  hash("md5", "image" . $count) . ".png");
                    $fotografiaModel = Fotografia::findOne(["id" => $fotografiaId]);
                    $objeto_resposta->anexos[$count] = $fotografiaModel->link;
                }
                $count+=1;
            } else {return "Apenas aceitamos imagens do tipo JPG, JPeG ou PNG";}


        }

        // Achar fotografia do produto
        $idProduto = $modelPedido->idProduto;
        $idFotografia = FotografiaProduto::findOne(["idProduto" => $idProduto])->idFotografia;
        $linkFotografiaProduto = Fotografia::findOne(["id"=>$idFotografia])->link;

        // Achar titulo do produto
        $tituloProduto = Produto::findOne(["id" => $idProduto])->tituloArtigo;

        // Criar objeto de ultima mensagem lida
        $ultima_lida = [];
        $ultima_lida[$user_uid] = [".sv"=>"timestamp"];

        $client = new Client();

        $id_canal = $modelPedido->id;

        // Criar Canal de Mensagem
        $response = $client->createRequest()
            ->setMethod("PUT")
            ->setFormat(Client::FORMAT_JSON)
            ->setUrl("https://ds3-gestorapedreira-default-rtdb.europe-west1.firebasedatabase.app/pedidos-listagem/" . $id_canal . ".json")
            ->setData([
                "pic"=>$linkFotografiaProduto,
                "titulo"=>$tituloProduto,
                "estado"=>$modelPedido->ultimoEstadoNome(),
                "ultima-mensagem"=>[
                    ".sv"=>"timestamp"
                ],
                "ultima-lida"=>$ultima_lida,
            ])
            ->send();

        // Buscar dados desse novo canal
        $response = $client->createRequest()
            ->setMethod("GET")
            ->setFormat(Client::FORMAT_JSON)
            ->setUrl("https://ds3-gestorapedreira-default-rtdb.europe-west1.firebasedatabase.app/pedidos-listagem/".$id_canal .".json")
            ->send();

        $dados_canal = $response->getData();
        $ultima_mensagem_timestamp = $dados_canal["ultima-mensagem"];


        $mensagem = "";
        if($modelPedido->mensagem !== null && $modelPedido->mensagem !== ""){
            $mensagem = $modelPedido->mensagem;

            // Adicionar primeira mensagem ao canal
            $response = $client->createRequest()
                ->setMethod("POST")
                ->setFormat(Client::FORMAT_JSON)
                ->setUrl("https://ds3-gestorapedreira-default-rtdb.europe-west1.firebasedatabase.app/pedidos-mensagens/". $id_canal . ".json")
                ->setData([
                    "_id" => $id_canal,
                    "createdAt" => $ultima_mensagem_timestamp,
                    "createdAtLocal" => $ultima_mensagem_timestamp,
                    "text" => $mensagem,
                    "user" => [
                        "_id" => $user_uid,
                        "name" => $user_name,
                        "avatar" => $user_avatar
                    ],
                    "anexos" => $objeto_resposta->anexos,
                    "sent"=>true
                ])
                ->send();
        }

        // Adicionar novo canal à lista de canais do usuário
        $response = $client->createRequest()
            ->setMethod("PUT")
            ->setFormat(Client::FORMAT_JSON)
            ->setUrl("https://ds3-gestorapedreira-default-rtdb.europe-west1.firebasedatabase.app/pedidos-canais/".$user_uid."/". $id_canal . ".json")
            ->setData([
                "visible" => true,
                "createdAt" => $ultima_mensagem_timestamp
            ])
            ->send();

        // Adicionar novo canal à lista de canais da conta partilhada de gestores
        $response = $client->createRequest()
            ->setMethod("PUT")
            ->setFormat(Client::FORMAT_JSON)
            ->setUrl("https://ds3-gestorapedreira-default-rtdb.europe-west1.firebasedatabase.app/pedidos-canais/".$conta_gestores_uid."/". $id_canal . ".json")
            ->setData([
                "visible" => true,
                "createdAt" => $ultima_mensagem_timestamp
            ])
            ->send();

        //return $response->getData();

        Logs::registrarLogUser($user->id, 2, "O usuário de ID " . $user->id . " adidicionou um(uns) anexo(s).");

        return $objeto_resposta;
    }

    public function actionLojaPesquisa(){
        $pesquisa = Yii::$app->request->get("titulo");
        $modelProdutos = ProdutoRest::find()->where(['like', 'tituloArtigo', $pesquisa])->all();
        return $modelProdutos;
    }
}