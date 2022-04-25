<?php

namespace app\controllers;

use app\models\Cor;
use app\models\EstadoPedido;
use app\models\Fotografia;
use app\models\FotografiaLote;
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
use app\models\UploadFormLote;
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
                        'actions' => ['home', 'index', 'lotes', 'novo-lote', 'stock', 'produtos', 'novo-produto', 'materiais', 'novo-material', 'cores', 'nova-cor', 'encomendas', 'encomendas-action', 'encomendas-mobilizacao', 'encomendas-agendar', 'confirmar-recolha', 'lotes-action'],
                        'allow' => true,
                        'roles' => ['operario'],
                    ],

                    [
                        'actions' => ['encomendas-next-step', 'cancelar-encomenda','transportadoras', 'nova-transportadora', 'loja', 'novo-produto-loja', 'clientes', 'operarios', 'logs'],
                        'allow' => true,
                        'roles' => ['gestor'],
                    ],

                    [
                        'actions' => ['gestores', 'administradores', 'locais-armazens', 'novo-local-armazem', 'locais-extracao', 'novo-local-extracao'],
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


    public function actionIndex()
    {
        $this->layout = 'main-fluid';
        return $this->redirect(['home']);
    }

    public function actionHome()
    {
        $this->layout = 'main-fluid';
        return $this->render('home');
    }

    public function actionEncomendas()
    {
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

    public function actionEncomendasAction($id)
    {
        $this->layout = 'main-fluid';
        $modelEncomenda = new Pedido();
        $modelEncomenda = $modelEncomenda->find()->where(['id' => $id])->one();

        return $this->render('encomendas_action', [
            'modelEncomenda' => $modelEncomenda,
        ]);
    }

    public function actionEncomendasNextStep($id)
    {
        //$step =

        $modelEncomenda = Pedido::find()->where(['id'=>$id])->one();
        $estadoAtual = $modelEncomenda->ultimoEstadoId();
        if($estadoAtual < 9){
            $modelEncomenda->nextState($id);
            Logs::registrarLogUser(Yii::$app->user->identity->id, 3, "O estado da encomenda #" . $modelEncomenda->id . " foi atualizada.");
            return $this->redirect(['dashboard/encomendas']);
        }
        else {
            return $this->redirect(['dashboard/encomendas']); // teste
        }

    }

    public function actionEncomendasMobilizacao($id)
    {
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


    public function actionCancelarEncomenda($idEncomenda){
        if(EstadoPedido::cancelarPedido($idEncomenda)){
            $this->redirect('/dashboard/encomendas');
        }
    }

    public function actionEncomendasAgendar($idEncomenda)
    {
        $this->layout = 'main-fluid';
        $modelEncomenda = new Pedido();
        $modelEncomenda = $modelEncomenda->find()->where(['id' => $idEncomenda])->one();
        $modelPedidoLote = new PedidoLote();

        $arrayLotes = Lote::getAllOfSpecificProductAsArray($modelEncomenda->idProduto);
        $arrayTransportadoras = Transportadora::getAllAsArray();

        //caso post
        if ($this->request->isPost) {
            if ($modelPedidoLote->load($this->request->post())) {
                $modelPedidoLote->idPedido = $idEncomenda;
                if($modelPedidoLote->save()){
                    if(Lote::reservarQuantidade($modelPedidoLote->codigoLote, $modelPedidoLote->quantidade)){
                        return $this->redirect([('dashboard/encomendas/' . $idEncomenda)]);
                    }

                }

            }
        } else {
            //$model->loadDefaultValues();
        }

        return $this->render('encomendas_agendar', [
            'modelEncomenda' => $modelEncomenda,
            'modelPedidoLote' => $modelPedidoLote,
            'arrayLotes' => $arrayLotes,
            'arrayTransportadoras' => $arrayTransportadoras
        ]);
    }

    public function actionConfirmarRecolha($idEncomenda, $idRecolha){
        $this->layout = 'main-fluid';
        $modelEncomenda = Pedido::find()->where(['id' => $idEncomenda])->one();
        $modelPedidoLote = PedidoLote::find()->where(['id' => $idRecolha])->one();

        //codigo para que seja redirecionado caso lote já tenha sido recolhido(dataHora definida)
        if(isset($modelPedidoLote->dataHora)){
            $this->redirect(['dashboard/encomendas']);
        }

        //caso post
        if ($this->request->isPost) {
            if ($modelPedidoLote->load($this->request->post())) {
                $modelPedidoLote->dataHoraRecolha = date('Y-m-d H:i:s');
                if($modelPedidoLote->save()){
                    Logs::registrarLogUser(Yii::$app->user->identity->id, 2, "Foi confirmada a recolha de ID #" . $modelPedidoLote->id . ", do lote " . $modelPedidoLote->codigoLote . ".");
                    return $this->redirect([('dashboard/encomendas/' . $idEncomenda)]);
                }
            }
        } else {
            //$model->loadDefaultValues();
        }

        return $this->render('confirmar-recolha',[
            'modelEncomenda' => $modelEncomenda,
            'modelPedidoLote' => $modelPedidoLote
        ]);
    }

    public function actionProdutos()
    {
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

    public function actionLoja()
    {
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

    public function actionNovoProduto()
    {
        $this->layout = 'main-fluid';
        $modelProduto = new Produto(['scenario' => Produto::SCENARIO_ADICIONARPRODUTO]);
        $arrayMateriais = Material::getAllAsArray();
        $arrayCores = Cor::getAllAsArray();

        //caso post
        if ($this->request->isPost) {
            if ($modelProduto->load($this->request->post()) && $modelProduto->save()) {
                Logs::registrarLogUser(Yii::$app->user->identity->id, 2, "O produto de ID #" . $modelProduto->id . " foi criado.");
                return $this->redirect(['dashboard/produtos']);
            }
        }

        return $this->render('novoProduto', [
            'modelProduto' => $modelProduto,
            'arrayMateriais' => $arrayMateriais,
            'arrayCores' => $arrayCores
        ]);
    }

    public function actionNovoProdutoLoja()
    {
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
                if ($modelProduto->adicionarLoja()) {
                    //sucesso no post
                    Logs::registrarLogUser(Yii::$app->user->identity->id, 3, "O produto '" . $modelProduto->tituloArtigo . "' foi adicionado à Loja.");
                    return $this->redirect(['dashboard/loja']);
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

    public function actionLotes()
    {
        $this->layout = 'main-fluid';
        $query = Lote::find();
        $provider = new ActiveDataProvider([ // cria objeto data provider
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        return $this->render('lotes', [
            'listaLotes' => $provider,
        ]);
    }

    public function actionLotesAction($codigo_lote){
        $this->layout = 'main-fluid';
        $modelLote = new Lote();
        $modelLote = $modelLote->find()->where(['codigo_lote' => $codigo_lote])->one();

        $queryFotografias = FotografiaLote::find()->where(['codigoLote' => $codigo_lote])->orderBy('id ASC');
        $provider = new ActiveDataProvider([ // cria objeto data provider
            'query' => $queryFotografias,
            'pagination' => [
                'pageSize' => 6,
            ],
        ]);

        return $this->render('lotes_action', [
            'modelLote' => $modelLote,
            'listaFotografias' => $provider
        ]);
    }


    public function actionStock()
    {
        $this->layout = 'main-fluid';
        $query = Produto::find();
        $provider = new ActiveDataProvider([ // cria objeto data provider
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        return $this->render('stock', [
            'listaStock' => $provider,
        ]);
    }

    public function actionClientes()
    {
        $this->layout = 'main-fluid';
        $query = User::find()->where(['role_id' => '4']);
        $provider = new ActiveDataProvider([ // cria objeto data provider
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        return $this->render('clientes', [
            'listaClientes' => $provider,
        ]);
    }

    public function actionOperarios()
    {
        $this->layout = 'main-fluid';
        $query = User::find()->where(['role_id' => '3']);
        $provider = new ActiveDataProvider([ // cria objeto data provider
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        return $this->render('operarios', [
            'listaOperarios' => $provider,
        ]);
    }

    public function actionGestores()
    {
        $this->layout = 'main-fluid';
        $query = User::find()->where(['role_id' => '2']);
        $provider = new ActiveDataProvider([ // cria objeto data provider
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        return $this->render('gestores', [
            'listaGestores' => $provider,
        ]);
    }

    public function actionAdministradores()
    {
        $this->layout = 'main-fluid';
        $query = User::find()->where(['role_id' => '1']);
        $provider = new ActiveDataProvider([ // cria objeto data provider
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        return $this->render('administradores', [
            'listaAdministradores' => $provider,
        ]);
    }

    public function actionLogs()
    {
        $this->layout = 'main-fluid';
        $query = Logs::find()->orderBy(['dataHora' => SORT_DESC]);
        $provider = new ActiveDataProvider([ // cria objeto data provider
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        return $this->render('logs', [
            'listaLogs' => $provider,
        ]);
    }

    public function actionMateriais()
    {
        $this->layout = 'main-fluid';
        $query = Material::find();
        $provider = new ActiveDataProvider([ // cria objeto data provider
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        return $this->render('materiais', [
            'listaMateriais' => $provider,
        ]);
    }

    public function actionCores()
    {
        $this->layout = 'main-fluid';
        $query = Cor::find();
        $provider = new ActiveDataProvider([ // cria objeto data provider
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        return $this->render('cores', [
            'listaCores' => $provider,
        ]);
    }

    public function actionTransportadoras()
    {
        $this->layout = 'main-fluid';
        $query = Transportadora::find();
        $provider = new ActiveDataProvider([ // cria objeto data provider
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        return $this->render('transportadoras', [
            'listaTransportadoras' => $provider,
        ]);
    }

    public function actionLocaisExtracao()
    {
        $this->layout = 'main-fluid';
        $query = LocalExtracao::find();
        $provider = new ActiveDataProvider([ // cria objeto data provider
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        return $this->render('locais-extracao', [
            'listaLocaisExtracao' => $provider,
        ]);
    }

    public function actionLocaisArmazens()
    {
        $this->layout = 'main-fluid';
        $query = LocalArmazem::find();
        $provider = new ActiveDataProvider([ // cria objeto data provider
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        return $this->render('locais-armazens', [
            'listaLocaisArmazens' => $provider,
        ]);
    }

    public function actionNovoLote()
    {
        $this->layout = 'main-fluid';
        $arrayProdutos = Produto::getAllAsArray();
        $arrayLocaisArmazens = LocalArmazem::getAllAsArray();
        $arrayLocaisExtracoes = LocalExtracao::getAllAsArray();
        $uploadFormLote = new UploadFormLote();

        // caso POST
        if ($this->request->isPost) {
            if ($uploadFormLote->load($this->request->post())) {
                $uploadFormLote->imageFiles = UploadedFile::getInstances($uploadFormLote, 'imageFiles');
                if ($uploadFormLote->uploadLotePictures($uploadFormLote->idProduto)) {
                    // file is uploaded successfully
                    Logs::registrarLogUser(Yii::$app->user->identity->id, 2, "O lote " . $uploadFormLote->codigo_lote . " foi adicionado.");
                    return $this->redirect(['dashboard/lotes']);
                }

            }
        }

        return $this->render('novoLote', [
            'modelLote' => $uploadFormLote,
            'arrayProdutos' => $arrayProdutos,
            'arrayLocaisArmazens' => $arrayLocaisArmazens,
            'arrayLocaisExtracoes' => $arrayLocaisExtracoes,
        ]);
    }

    public function actionNovoMaterial()
    {
        $this->layout = 'main-fluid';
        $modelMaterial = new Material();

        //caso post
        if ($this->request->isPost) {
            if ($modelMaterial->load($this->request->post()) && $modelMaterial->save()) {
                Logs::registrarLogUser(Yii::$app->user->identity->id, 2, "O material '" . $modelMaterial->nome . "' foi criado.");
                return $this->redirect(['dashboard/materiais']);
            }
        }

        return $this->render('novoMaterial', [
            'modelMaterial' => $modelMaterial,
        ]);

    }

    public function actionNovaCor()
    {
        $this->layout = 'main-fluid';
        $modelCor = new Cor();

        //caso post
        if ($this->request->isPost) {
            if ($modelCor->load($this->request->post()) && $modelCor->save()) {
                Logs::registrarLogUser(Yii::$app->user->identity->id, 2, "A cor '" . $modelCor->nome . "' foi criada.");
                return $this->redirect(['dashboard/cores']);
            }
        }

        return $this->render('novaCor', [
            'modelCor' => $modelCor,
        ]);
    }

    public function actionNovaTransportadora()
    {
        $this->layout = 'main-fluid';
        $modelTransportadora = new Transportadora();

        //caso post
        if ($this->request->isPost) {
            if ($modelTransportadora->load($this->request->post()) && $modelTransportadora->save()) {
                Logs::registrarLogUser(Yii::$app->user->identity->id, 3, "A transportadora '" . $modelTransportadora->nome . "' foi adicionada.");
                return $this->redirect(['dashboard/transportadoras']);
            }
        }

        return $this->render('novaTransportadora', [
            'modelTransportadora' => $modelTransportadora,
        ]);
    }

    public function actionNovoLocalArmazem()
    {
        $this->layout = 'main-fluid';
        $modelLocalArmazem = new LocalArmazem();

        //caso post
        if ($this->request->isPost) {
            if ($modelLocalArmazem->load($this->request->post()) && $modelLocalArmazem->save()) {
                Logs::registrarLogUser(Yii::$app->user->identity->id, 2, "O local de armazém '" . $modelLocalArmazem->nome . "' foi criado.");
                return $this->redirect(['dashboard/locais-armazens']);
            }
        }

        return $this->render('novoLocalArmazem', [
            'modelLocalArmazem' => $modelLocalArmazem,
        ]);
    }

    public function actionNovoLocalExtracao()
    {
        $this->layout = 'main-fluid';
        $modelLocalExtracao = new LocalExtracao();

        //caso post
        if ($this->request->isPost) {
            if ($modelLocalExtracao->load($this->request->post()) && $modelLocalExtracao->save()) {
                Logs::registrarLogUser(Yii::$app->user->identity->id, 2, "O local de extração '" . $modelLocalExtracao->nome . "' foi criado.");
                return $this->redirect(['dashboard/locais-extracao']);
            }
        }

        return $this->render('novoLocalExtracao', [
            'modelLocalExtracao' => $modelLocalExtracao,
        ]);

    }

}