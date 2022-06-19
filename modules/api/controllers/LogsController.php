<?php

namespace app\modules\api\controllers;


use app\modules\api\models\LogsRest;
use Yii;
use yii\rest\ActiveController;

class LogsController extends BaseController
{
    public $modelClass = LogsRest::class;

    public function behaviors(){
        $behaviors = parent::behaviors();
        $behaviors['access']['rules'][] = [
            'actions' =>  ['index', 'view', 'options', 'listar'],
            'allow' => true,
            'roles' => ['gestor'] // se tirar o role, qualquer utilizar AUTENTICADO pode usar o serviço.
        ];
        $behaviors['access']['rules'][] = [
            'actions' =>  [ 'delete', 'add', 'create', 'update'  ],
            'allow' => true,
            'roles' => ['admin'] // se tirar o role, qualquer utilizar AUTENTICADO pode usar o serviço.
        ];

        return $behaviors;
    }

    public function actionListar(){
        if(isset($_GET["teste"]) && $_GET["teste"] === "1"){
            return ["sucesso"];
        }
        $model = new LogsRest();
        $get = Yii::$app->request->get(); //esta linha de código vai buscar os parâmetros de query do REQUEST (ex: ?grau="licensiatura)
        $dataProvider = $model->dadosListar($get);

        return $dataProvider;
    }

    public function actionAdd(){
        $model = new LogsRest();
        $model->load(Yii::$app->request->post(), '');
        $model->dataHora = date('y-m-d H:i:s', time());
        $model->save();
        return $model;
    }

}