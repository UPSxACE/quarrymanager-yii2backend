<?php

namespace app\modules\api\controllers;


use app\modules\api\models\TransportadoraRest;
use Yii;
use yii\rest\ActiveController;

class TransportadoraController extends BaseController
{
    public $modelClass = TransportadoraRest::class;

    public function behaviors(){
        $behaviors = parent::behaviors();
        $behaviors['access']['rules'][] = [

            'actions' =>  ['index', 'view', 'create', 'update', 'delete', 'options', 'listar', 'add', 'delete-transportadora', 'editar', 'find' ],
            'allow' => true,
            'roles' => ['operario'] // se tirar o role, qualquer utilizar AUTENTICADO pode usar o serviço.
        ];

        return $behaviors;
    }

    public function actionListar(){
        $model = new TransportadoraRest();
        $get = Yii::$app->request->get(); //esta linha de código vai buscar os parâmetros de query do REQUEST (ex: ?grau="licensiatura)
        $dataProvider = $model->dadosListar($get);

        return $dataProvider;
    }

    public function actionAdd(){
        $model = new TransportadoraRest();
        $model->load(Yii::$app->request->post(), '');
        $model->save();
        return $model;
    }


    public function actionDeleteTransportadora(){
        $model =  TransportadoraRest::find()->where(['id' => Yii::$app->request->post('id')])->one();
        $model->delete();
        return "Deletado com sucesso";
    }


    public function actionEditar(){
        $model = TransportadoraRest::find()->where(['id' =>Yii::$app->request->post('id')])->one();
        $model->load(yii::$app->request->post(), '');
        $model->save();
        return $model;
    }
    public function actionFind(){
        $model = TransportadoraRest::find()->where(['id'=>Yii::$app->request->get('id')])->one();
        return $model;
    }
}

