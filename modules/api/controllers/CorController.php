<?php

namespace app\modules\api\controllers;


use app\modules\api\models\CorRest;
use app\modules\api\models\LoteRest;
use Yii;
use yii\rest\ActiveController;

class CorController extends BaseController
{
    public $modelClass = CorRest::class;

    public function behaviors(){
        $behaviors = parent::behaviors();
        $behaviors['access']['rules'][] = [
            'actions' =>  ['index', 'view', 'create', 'update', 'delete', 'options', 'listar' ,'editar' ],
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

    public function actionEditar(){
        $model = CorRest::find()->where(['id' =>Yii::$app->request->post('id')])->one();
        $model->load(yii::$app->request->post(), '');
        $model->save();
        return $model;
    }
}