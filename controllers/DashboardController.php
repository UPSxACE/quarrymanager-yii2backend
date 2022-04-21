<?php

namespace app\controllers;

use app\models\Cor;
use app\models\EstadoPedido;
use app\models\Fotografia;
use app\models\LocalArmazem;
use app\models\LocalExtracao;
use app\models\Logs;
use app\models\Lote;
use app\models\Material;
use app\models\Pedido;
use app\models\PedidoLote;
use app\models\Produto;
use app\models\Profile;
use app\models\Transportadora;
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
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['home', 'index', 'lotes', 'stock', 'produtos', 'novo-produto', 'materiais', 'cores', 'encomendas', 'encomendas-action', 'encomendas-mobilizacao', 'encomendas-agendar' ],
                        'allow' => true,
                        'roles' => ['operario'],
                    ],

                    [
                        'actions' => ['transportadoras', 'loja', 'novo-produto-loja', 'clientes', 'operarios'],
                        'allow' => true,
                        'roles' => ['gestor'],
                    ],

                    [
                        'actions' => ['gestores', 'administradores', 'locais-armazens', 'locais-extracao'],
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }




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
        $query = EstadoPedido::find()->where(['last' => '1']);
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

    public function actionEncomendasAction($id){
        $this->layout = 'main-fluid';
        $modelEncomenda = new Pedido();
        $modelEncomenda = $modelEncomenda->find()->where(['id' => $id])->one();

        return $this->render('encomendas_action', [
            'modelEncomenda' => $modelEncomenda,
        ]);
    }

    public function actionEncomendasActionTooltipStep(){
        //$step =
        $this->redirect('produtos'); // teste
    }

    public function actionEncomendasMobilizacao($id){
        $this->layout = 'main-fluid';
        $modelEncomenda = new Pedido();
        $modelEncomenda = $modelEncomenda->find()->where(['id' => $id])->one();

        //data provider
        $query = PedidoLote::find()->where(['idPedido' => $id])->orderBy('dataHoraRecolha ASC'); //não recolhidos sempre vão aparecer primeiro
        $provider = new ActiveDataProvider([ // cria objeto data provider
            'query' => $query,
            'pagination' => [
                'pageSize' => 4,
            ],
        ]);

        return $this->render('encomendas_mobilizacao', [
            'modelEncomenda' => $modelEncomenda,
            'listaPedidoLote' => $provider
        ]);
    }

    public function actionEncomendasAgendar($idEncomenda){
        $this->layout = 'main-fluid';
        $modelEncomenda = new Pedido();
        $modelEncomenda = $modelEncomenda->find()->where(['id' => $idEncomenda])->one();
        $modelPedidoLote = new PedidoLote();

        //data provider

        return $this->render('encomendas_agendar', [
            'modelEncomenda' => $modelEncomenda,
            'modelPedidoLote' => $modelPedidoLote
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

    public function actionLoja(){
        $this->layout = 'main-fluid';
        $query = Produto::find();
        $provider = new ActiveDataProvider([ // cria objeto data provider
            'query' => $query,
            'pagination' => [
                'pageSize' => 12,
            ],
        ]);

        return $this->render('loja', [
            'listaProdutos' => $provider,
        ]);
    }

    public function actionNovoProduto(){
        $this->layout = 'main-fluid';
        $modelProduto = new Produto(['scenario' => Produto::SCENARIO_ADICIONARPRODUTO]);
        $arrayMateriais = Material::getAllAsArray();
        $arrayCores = Cor::getAllAsArray();

        //caso post
        if ($this->request->isPost) {
            if($modelProduto->load($this->request->post()) && $modelProduto->save()){
                return $this->redirect(['dashboard/produtos']);
            }
        }

        return $this->render('novoProduto', [
            'modelProduto' => $modelProduto,
            'arrayMateriais' => $arrayMateriais,
            'arrayCores' => $arrayCores
        ]);
    }

    public function actionNovoProdutoLoja(){
        $this->layout = 'main-fluid';
        $modelProduto = new Produto(['scenario' => Produto::SCENARIO_ADICIONARLOJA]);
        $modelFotografia = new Fotografia();
        $arrayMateriais = Material::getAllAsArray();
        $arrayCores = Cor::getAllAsArray();
        $arrayProdutos = Produto::getAllForaDaLojaAsArray();

        //caso post
        if ($this->request->isPost) {
            //uploaded file save
            if (Yii::$app->request->isPost) {
                /* CODIGO ANTIGO
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
                CODIGO ANTIGO */
                $modelProduto->load($this->request->post());
                $modelProduto->imageFile = UploadedFile::getInstance($modelProduto, 'imageFile');
                if($modelProduto->adicionarLoja()){
                    //sucesso no post
                    return $this->redirect(['dashboard/produtos']);
                }
            }
        } else {
            //$modelPerfil->loadDefaultValues();
        }



        return $this->render('novoProdutoLoja', [
            'modelProduto' => $modelProduto,
            'arrayMateriais' => $arrayMateriais,
            'arrayCores' => $arrayCores,
            'arrayProdutos' => $arrayProdutos
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

    public function actionMateriais(){
        $this->layout = 'main-fluid';
        $query = Material::find();
        $provider = new ActiveDataProvider([ // cria objeto data provider
            'query' => $query,
            'pagination' => [
                'pageSize' => 12,
            ],
        ]);

        return $this->render('materiais', [
            'listaMateriais' => $provider,
        ]);
    }

    public function actionCores(){
        $this->layout = 'main-fluid';
        $query = Cor::find();
        $provider = new ActiveDataProvider([ // cria objeto data provider
            'query' => $query,
            'pagination' => [
                'pageSize' => 12,
            ],
        ]);

        return $this->render('cores', [
            'listaCores' => $provider,
        ]);
    }

    public function actionTransportadoras(){
        $this->layout = 'main-fluid';
        $query = Transportadora::find();
        $provider = new ActiveDataProvider([ // cria objeto data provider
            'query' => $query,
            'pagination' => [
                'pageSize' => 12,
            ],
        ]);

        return $this->render('transportadoras', [
            'listaTransportadoras' => $provider,
        ]);
    }

    public function actionLocaisExtracao(){
        $this->layout = 'main-fluid';
        $query = LocalExtracao::find();
        $provider = new ActiveDataProvider([ // cria objeto data provider
            'query' => $query,
            'pagination' => [
                'pageSize' => 12,
            ],
        ]);

        return $this->render('locais-extracao', [
            'listaLocaisExtracao' => $provider,
        ]);
    }

    public function actionLocaisArmazens(){
        $this->layout = 'main-fluid';
        $query = LocalArmazem::find();
        $provider = new ActiveDataProvider([ // cria objeto data provider
            'query' => $query,
            'pagination' => [
                'pageSize' => 12,
            ],
        ]);

        return $this->render('locais-armazens', [
            'listaLocaisArmazens' => $provider,
        ]);
    }
}