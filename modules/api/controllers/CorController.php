<?php

namespace app\modules\api\controllers;


use app\modules\api\models\CorRest;
use Yii;
use yii\rest\ActiveController;

class CorController extends BaseController
{
    public $modelClass = CorRest::class;

    public function behaviors(){
        $behaviors = parent::behaviors();
        $behaviors['access']['rules'][] = [
            'actions' =>  ['index', 'view', 'create', 'update', 'delete', 'options', 'listar', 'add' ],
            'allow' => true,
            'roles' => ['operario'] // se tirar o role, qualquer utilizar AUTENTICADO pode usar o serviço.
        ];

        return $behaviors;
    }

    public function actionListar(){
        $model = new CorRest();
        $get = Yii::$app->request->get(); //esta linha de código vai buscar os parâmetros de query do REQUEST (ex: ?grau="licensiatura)
        $dataProvider = $model->dadosListar($get);

        return $dataProvider;
    }

    public function actionAdd(){
        $modelCor = new CorRest();
        $modelCor->load(Yii::$app->request->post(), '');
        $modelCor->save();
        return $modelCor;
    }
}