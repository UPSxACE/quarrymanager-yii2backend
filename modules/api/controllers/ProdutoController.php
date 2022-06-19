<?php

namespace app\modules\api\controllers;


use app\models\Produto;
use app\modules\api\models\ProdutoRest;
use app\modules\api\models\UserRest;
use Yii;
use yii\rest\ActiveController;

class ProdutoController extends BaseController
{
    public $modelClass = ProdutoRest::class;

    public function behaviors(){
        $behaviors = parent::behaviors();
        $behaviors['access']['rules'][] = [


            'actions' =>  ['index', 'view', 'create', 'update', 'delete', 'options', 'listar', 'add', 'delete-produto', 'editar', 'find', 'produtos-loja' ],
            'allow' => true,
            'roles' => ['operario'] // se tirar o role, qualquer utilizar AUTENTICADO pode usar o serviço.
        ];

        return $behaviors;
    }

    public function actionListar(){
        //$model = new ProdutoRest(['scenario' => ProdutoRest::SCENARIO_LOJA]);
        $model = new ProdutoRest();
        $get = Yii::$app->request->get(); //esta linha de código vai buscar os parâmetros de query do REQUEST (ex: ?grau="licensiatura)
        $dataProvider = $model->dadosListar($get);

        return $dataProvider;
    }

    public function actionAdd(){
        $access_header = Yii::$app->request->headers->get("Authorization");
        $access_token = str_replace("Basic ", "", $access_header);
        $access_token = base64_decode($access_token);
        $access_token = str_replace(":", "", $access_token);
        $user = UserRest::findOne(["access_token" => $access_token]);

        $model = new ProdutoRest();
        $model->load(Yii::$app->request->post(), '');
        $model->save();
        Logs::registrarLogUser($user->id, 3, "O produto de ID #" . $model->id . "' foi adicionado.");
        return $model;
    }


    public function actionDeleteProduto(){
        $access_header = Yii::$app->request->headers->get("Authorization");
        $access_token = str_replace("Basic ", "", $access_header);
        $access_token = base64_decode($access_token);
        $access_token = str_replace(":", "", $access_token);
        $user = UserRest::findOne(["access_token" => $access_token]);

        $model =  ProdutoRest::find()->where(['id' => Yii::$app->request->get('id')])->one();
        $model->delete();
        Logs::registrarLogUser($user->id, 3, "O produto de ID #" . $model->id . "' foi eliminado.");
        return "Deletado com sucesso";
    }


    public function actionProdutosLoja(){

        $dataProvider = ProdutoRest::listarProdutosLoja();

        return $dataProvider;
    }


    public function actionEditar(){
        $access_header = Yii::$app->request->headers->get("Authorization");
        $access_token = str_replace("Basic ", "", $access_header);
        $access_token = base64_decode($access_token);
        $access_token = str_replace(":", "", $access_token);
        $user = UserRest::findOne(["access_token" => $access_token]);

        $model = ProdutoRest::find()->where(['id' =>Yii::$app->request->post('id')])->one();
        $model->load(yii::$app->request->post(), '');
        $model->save();
        Logs::registrarLogUser($user->id, 3, "O produto de ID #" . $model->id . "' foi modificado.");
        return $model;
    }

    public function actionFind(){
        $model = ProdutoRest::find()->where(['id'=>Yii::$app->request->get('id')])->one();
        return $model;
    }
}


