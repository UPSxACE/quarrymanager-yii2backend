<?php

namespace app\controllers;

use app\models\Cor;
use app\models\EstadoPedido;
use app\models\Fotografia;
use app\models\Logs;
use app\models\Lote;
use app\models\Material;
use app\models\Pedido;
use app\models\Produto;
use app\models\Profile;
use app\models\User;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

class DashboardController extends Controller
{
    public function actionIndex(){
        $this->layout = 'main-fluid';
        return $this->redirect(['home']);
    }

    public function actionHome(){
        $this->layout = 'main-fluid';
        return $this->render('home');
    }

    public function actionEncomendas(){
        $this->layout = 'main-fluid';
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
        $this->layout = 'main-fluid';
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
        $this->layout = 'main-fluid';
        $modelProduto = new Produto();
        $modelFotografia = new Fotografia();
        $arrayMateriais = Material::getAllAsArray();
        $arrayCores = Cor::getAllAsArray();

        //caso post
        if ($this->request->isPost) {
            //uploaded file save
            if (Yii::$app->request->isPost) {

                $modelProduto->load($this->request->post());
                $modelProduto->imageFile = UploadedFile::getInstance($modelProduto, 'imageFile');
                if ($modelProduto->uploadProductPicture()) {
                    //codigo NOVO
                    $modelFotografia = new Fotografia();
                    $modelFotografia->link = 'productPictures/' . $modelProduto->imageFile->baseName . '.' . $modelProduto->imageFile->extension;
                    if(!$modelFotografia->save()){
                        //código para lidar com erro ao guardar imagem(irá ser feito futuramente)
                    } else {
                        $modelProduto->idFotografia = $modelFotografia->id;
                        if(!$modelProduto->save()){
                            //código para lidar com erro ao guardar imagem(irá ser feito futuramente)
                        }
                    }

                    // file is uploaded successfully
                    return $this->redirect(['dashboard/produtos']);
                }
            }
        } else {
            //$modelPerfil->loadDefaultValues();
        }



        return $this->render('novoProduto', [
            'modelProduto' => $modelProduto,
            'arrayMateriais' => $arrayMateriais,
            'arrayCores' => $arrayCores
        ]);
    }

    public function actionLotes(){
        $this->layout = 'main-fluid';
        $query = Lote::find();
        $provider = new ActiveDataProvider([ // cria objeto data provider
            'query' => $query,
            'pagination' => [
                'pageSize' => 12,
            ],
        ]);

        return $this->render('lotes', [
            'listaLotes' => $provider,
        ]);
    }

    public function actionStock(){
        $this->layout = 'main-fluid';
        $query = Produto::find();
        $provider = new ActiveDataProvider([ // cria objeto data provider
            'query' => $query,
            'pagination' => [
                'pageSize' => 12,
            ],
        ]);

        return $this->render('stock', [
            'listaStock' => $provider,
        ]);
    }

    public function actionClientes(){
        $this->layout = 'main-fluid';
        $query = User::find()->where(['role_id' => '4']);
        $provider = new ActiveDataProvider([ // cria objeto data provider
            'query' => $query,
            'pagination' => [
                'pageSize' => 12,
            ],
        ]);

        return $this->render('clientes', [
            'listaClientes' => $provider,
        ]);
    }

    public function actionOperarios(){
        $this->layout = 'main-fluid';
        $query = User::find()->where(['role_id' => '3']);
        $provider = new ActiveDataProvider([ // cria objeto data provider
            'query' => $query,
            'pagination' => [
                'pageSize' => 12,
            ],
        ]);

        return $this->render('operarios', [
            'listaOperarios' => $provider,
        ]);
    }

    public function actionGestores(){
        $this->layout = 'main-fluid';
        $query = User::find()->where(['role_id' => '2']);
        $provider = new ActiveDataProvider([ // cria objeto data provider
            'query' => $query,
            'pagination' => [
                'pageSize' => 12,
            ],
        ]);

        return $this->render('gestores', [
            'listaGestores' => $provider,
        ]);
    }

    public function actionAdministradores(){
        $this->layout = 'main-fluid';
        $query = User::find()->where(['role_id' => '1']);
        $provider = new ActiveDataProvider([ // cria objeto data provider
            'query' => $query,
            'pagination' => [
                'pageSize' => 12,
            ],
        ]);

        return $this->render('administradores', [
            'listaAdministradores' => $provider,
        ]);
    }

    public function actionLogs(){
        $this->layout = 'main-fluid';
        $query = Logs::find();
        $provider = new ActiveDataProvider([ // cria objeto data provider
            'query' => $query,
            'pagination' => [
                'pageSize' => 12,
            ],
        ]);

        return $this->render('logs', [
            'listaLogs' => $provider,
        ]);
    }
}