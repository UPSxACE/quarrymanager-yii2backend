<?php

namespace app\controllers;

use app\models\EstadoPedido;
use app\models\Loja;
use app\models\Pedido;
use app\models\Produto;
use app\models\Profile;
use Yii;
use yii\data\ActiveDataProvider;
use yii\db\Query;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;


class LojaController extends Controller{
    public function actionIndex(){
        $query = Produto::find()->where(['na_loja' => '1'])->orderBy('id DESC'); // não adicionar o all(), porque o all() executa a query, e quem vai executar a query vai ser o objeto do ActiveDataProvider
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
        $modelPedido = new Pedido();
        $modelEstadoPedido = new EstadoPedido();
        $modelPerfil = new Profile();



        //post
        if ($this->request->isPost) {
            $modelPedido->idUser = Yii::$app->user->identity->id;
            $modelPedido->dataHoraPedido = date('Y-m-d H:i:s');
            $modelPedido->idProduto = $id;
            if ($modelPedido->load($this->request->post()) && $modelPedido->save()) {
                $modelEstadoPedido->idEstado = '1';
                $modelEstadoPedido->idPedido = $modelPedido->id;
                $modelEstadoPedido->dataEstado = $modelPedido->dataHoraPedido;

                if($modelEstadoPedido->save()){
                    Yii::$app->session->setFlash("Orcamento-success", Yii::t("user", "Pedido de orçamento enviado."));
                    return $this->refresh();
                } /*else {
                    //mensagem de erro
                } */
            }
        } else {
            $modelPedido->loadDefaultValues();
        }

        return $this->render('produto', [
            'produto' => $produto,
            'modelPedido' => $modelPedido,
            'modelPerfil' => $modelPerfil
        ]);
    }
}