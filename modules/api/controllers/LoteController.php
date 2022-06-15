<?php

namespace app\modules\api\controllers;


use app\modules\api\models\LoteRest;
use Yii;
use yii\rest\ActiveController;

class LoteController extends BaseController
{
    public $modelClass = LoteRest::class;

    public function behaviors(){
        $behaviors = parent::behaviors();
        $behaviors['access']['rules'][] = [

            'actions' =>  ['index', 'view', 'create', 'update', 'delete', 'options', 'listar', 'add', 'delete-lote', 'editar' ],
            'allow' => true,
            'roles' => ['operario'] // se tirar o role, qualquer utilizar AUTENTICADO pode usar o serviço.
        ];

        return $behaviors;
    }

    public function actionListar(){
        $model = new LoteRest();
        $get = Yii::$app->request->get(); //esta linha de código vai buscar os parâmetros de query do REQUEST (ex: ?grau="licensiatura)
        $dataProvider = $model->dadosListar($get);

        return $dataProvider;
    }


    public function actionAdd(){
        $model = new LoteRest();
        $model->load(Yii::$app->request->post(), '');
        $model->save();
        return $model;
    }

    public function actionDeleteLote(){


        $model =  LoteRest::find()->where(['codigo_lote' => Yii::$app->request->post('codigo_lote')])->one();

        $model->delete();
        return "Deletado com sucesso";
    }

    public function actionEditar(){
        $model = LoteRest::find()->where(['codigo_lote' =>Yii::$app->request->post('codigo_lote')])->one();
        $model->load(yii::$app->request->post(), '');
        $model->save();
        return $model;
    }

}