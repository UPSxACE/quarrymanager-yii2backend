<?php

namespace app\controllers;

use app\models\Loja;
use app\models\Produto;
use yii\data\ActiveDataProvider;
use yii\db\Query;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;


class LojaController extends Controller{
    public function actionIndex(){

        //$listaProdutos = Produto::getAllProducts();
        //foreach($listaProdutos as $produto){
        //$tituloProduto = $produto->tituloArtigo;
        //echo "<h1>" . $tituloProduto . "<h1>";
        //}

        /*
        $listaProdutos = Produto::getAllProducts();
        */

        //$query = Produto::find(); //busca todos os produtos da base de dados


        //$produtoQuery = new Query;
        //$produtoQuery->select('produto.id, tituloArtigo, descricaoProduto, preco, material.nome, cor.nome')->from('produto')->innerJoin("material", "material.id=produto.idMaterial")->innerJoin("cor", "cor.id=produto.idCor")->all();
        //$query = $produtoQuery; //busca todos os produtos da base de dados
        $query = Produto::find()->orderBy('id DESC'); // não adicionar o all(), porque o all() executa a query, e quem vai executar a query vai ser o objeto do ActiveDataProvider
        $provider = new ActiveDataProvider([ // cria objeto data provider
            'query' => $query,
            'pagination' => [
                'pageSize' => 8,
            ],
        ]);

        return $this->render('index', [
            'listaProdutos' => $provider,
        ]);
    }

    public function actionProduto($id){
        $produto = new Produto();
        $produto = $produto->find()->where(['id' => $id])->one();
        return $this->render('produto', [
            'produto' => $produto,
        ]);
    }
}