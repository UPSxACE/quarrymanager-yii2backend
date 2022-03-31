<?php

namespace app\controllers;

use app\models\Loja;
use app\models\Produto;
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

        $listaProdutos = Produto::getAllProducts();


        return $this->render('index', [
            'listaProdutos' => $listaProdutos,
        ]);
    }
}