<?php

namespace app\controllers;

use app\models\Cor;
use app\models\EstadoPedido;
use app\models\Material;
use app\models\Pedido;
use app\models\Produto;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class DashboardController extends Controller
{
    public function actionIndex(){
        return $this->redirect(['home']);
    }

    public function actionHome(){
        return $this->render('home');
    }

    public function actionEncomendas(){
        $query = EstadoPedido::find();
        $provider = new ActiveDataProvider([ // cria objeto data provider
            'query' => $query,
            'pagination' => [
                'pageSize' => 12,
            ],
        ]);

        return $this->render('encomendas', [
            'listaEncomendas' => $provider,
        ]);
    }

    public function actionProdutos(){
        $query = Produto::find();
        $provider = new ActiveDataProvider([ // cria objeto data provider
            'query' => $query,
            'pagination' => [
                'pageSize' => 12,
            ],
        ]);

        return $this->render('produtos', [
            'listaProdutos' => $provider,
        ]);
    }

    public function actionNovoProduto(){
        $modelProduto = new Produto();
        $arrayMateriais = Material::getAllAsArray();
        $arrayCores = Cor::getAllAsArray();

        return $this->render('novoProduto', [
            'modelProduto' => $modelProduto,
            'arrayMateriais' => $arrayMateriais,
            'arrayCores' => $arrayCores
        ]);
    }

}