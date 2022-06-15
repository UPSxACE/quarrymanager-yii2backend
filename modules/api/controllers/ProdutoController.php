<?php

namespace app\modules\api\controllers;


use app\models\Produto;
use app\modules\api\models\ProdutoRest;
use Yii;
use yii\rest\ActiveController;

class ProdutoController extends BaseController
{
    public $modelClass = ProdutoRest::class;

    public function behaviors(){
        $behaviors = parent::behaviors();
        $behaviors['access']['rules'][] = [
            'actions' =>  ['index', 'view', 'create', 'update', 'delete', 'options', 'listar', 'add', 'delete-produto' ],
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
        $model = new ProdutoRest();
        $model->load(Yii::$app->request->post(), '');
        $model->save();
        return $model;
    }

    public function actionDeleteProduto(){
        $model =  ProdutoRest::find()->where(['id' => Yii::$app->request->post('id')])->one();
        $model->delete();
        return "Deletado com sucesso";
    }
}