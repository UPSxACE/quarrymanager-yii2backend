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
            'actions' =>  ['index', 'view', 'create', 'update', 'delete', 'options', 'listar' ],
            'allow' => true,
            'roles' => ['operario'] // se tirar o role, qualquer utilizar AUTENTICADO pode usar o serviço.
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


}