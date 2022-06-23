<?php

namespace app\modules\api\controllers;


use app\models\Fotografia;
use app\models\FotografiaProduto;
use app\models\LocalArmazem;
use app\models\LocalExtracao;
use app\models\Logs;
use app\models\Produto;
use app\modules\api\models\LoteRest;
use app\modules\api\models\UserRest;
use Yii;
use yii\helpers\FileHelper;
use yii\rest\ActiveController;

class LoteController extends BaseController
{
    public $modelClass = LoteRest::class;

    public function behaviors(){
        $behaviors = parent::behaviors();
        $behaviors['access']['rules'][] = [

            'actions' =>  ['index', 'view', 'create', 'update', 'delete', 'options', 'listar', 'add', 'delete-lote', 'editar' , 'find', 'options-novo-lote' ],
            'allow' => true,
            'roles' => ['operario'] // se tirar o role, qualquer utilizar AUTENTICADO pode usar o serviço.
        ];

        return $behaviors;
    }

    public function actionListar(){
        $model = new LoteRest();
        $get = Yii::$app->request->get(); //esta linha de código vai buscar os parâmetros de query do REQUEST (ex: ?grau="licensiatura)
        $dataProvider = $model->dadosListar($get);

        return $dataProvider;
    }

    public function actionOptionsNovoLote(){
        $arrayProdutos = Produto::getAllAsArray();
        $arrayLocaisArmazens = LocalArmazem::getAllAsArray();
        $arrayLocaisExtracoes = LocalExtracao::getAllAsArray();

        return ["produtos" => $arrayProdutos, "locais-armazem" => $arrayLocaisArmazens, "locais-extracoes" => $arrayLocaisExtracoes];
    }

    public function actionAdd(){

        $access_header = Yii::$app->request->headers->get("Authorization");
        $access_token = str_replace("Basic ", "", $access_header);
        $access_token = base64_decode($access_token);
        $access_token = str_replace(":", "", $access_token);
        $user = UserRest::findOne(["access_token"=>$access_token]);



        $model = new LoteRest();
        $idProduto = Yii::$app->request->post("idProduto");
        $codigo_lote = LoteRest::gerarCodigoLote($idProduto);
        $model->load(Yii::$app->request->post(), '');
        $model->codigo_lote = $codigo_lote;
        $model->save();

        $count = 0;
        FileHelper::createDirectory('uploads/lotes/' . $codigo_lote . '/', 0775);
        foreach ($_FILES as $file){

            if($file["type"] === "image/jpeg" || $file["type"] === "image/jpg"){
                if(move_uploaded_file($file["tmp_name"], "uploads/lotes/" . $codigo_lote . "/" . "image" . $count . ".jpg")){
                    $fotografiaModel = Fotografia::registrarFotografia("lotes/" . $codigo_lote . "/" . "image" . $count . ".jpg");

                    $fotografia_produto = new FotografiaProduto();
                    $fotografia_produto->idProduto = Yii::$app->request->post("idProduto");
                    $fotografia_produto->idFotografia = $fotografiaModel;
                }
                $count+=1;
            } elseif ($file["type"] === "image/png"){
                if(move_uploaded_file($file["tmp_name"], "uploads/lotes/" . $codigo_lote . "/" . "image" . $count . ".png")){
                    $fotografiaModel = Fotografia::registrarFotografia("lotes/" . $codigo_lote . "/" . "image" . $count . ".png");

                    $fotografia_produto = new FotografiaProduto();
                    $fotografia_produto->idProduto = Yii::$app->request->post("idProduto");
                    $fotografia_produto->idFotografia = $fotografiaModel;
                }
                $count+=1;
            } else {return "Apenas aceitamos imagens do tipo JPG, JPeG ou PNG";}


        }

        //if(isset($_FILES["file0"]))
        Logs::registrarLogUser($user->id, 2, "O lote " . $model->codigo_lote . " foi adicionado.");

        return $model;
    }

    public function actionDeleteLote(){
        $access_header = Yii::$app->request->headers->get("Authorization");
        $access_token = str_replace("Basic ", "", $access_header);
        $access_token = base64_decode($access_token);
        $access_token = str_replace(":", "", $access_token);
        $user = UserRest::findOne(["access_token"=>$access_token]);


        $model =  LoteRest::find()->where(['codigo_lote' => Yii::$app->request->get('codigo_lote')])->one();

        $model->delete();
        Logs::registrarLogUser($user->id, 2, "O Lote de ID #" . $model->codigo_lote . " foi eliminado");
        return "Deletado com sucesso";
    }

    public function actionEditar(){
        $access_header = Yii::$app->request->headers->get("Authorization");
        $access_token = str_replace("Basic ", "", $access_header);
        $access_token = base64_decode($access_token);
        $access_token = str_replace(":", "", $access_token);
        $user = UserRest::findOne(["access_token"=>$access_token]);

        $model = LoteRest::find()->where(['codigo_lote' =>Yii::$app->request->post('codigo_lote')])->one();
        $model->load(yii::$app->request->post(), '');
        $model->save();
        Logs::registrarLogUser($user->id, 2, "O Lote de ID #" . $model->codigo_lote . " foi modificado.");
        return $model;
    }

    public function actionFind(){
        $model = LoteRest::find()->where(['codigo_lote'=>Yii::$app->request->get('codigo_lote')])->one();
        return $model;
    }
}