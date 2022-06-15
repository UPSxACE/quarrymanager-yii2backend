<?php

namespace app\modules\api\controllers;


use app\modules\api\models\LocalArmazemRest;
use Yii;


class LocalArmazemController extends BaseController
{
    public $modelClass = LocalArmazemRest::class;

    public function behaviors(){
        $behaviors = parent::behaviors();
        $behaviors['access']['rules'][] = [

            'actions' =>  ['index', 'view', 'create', 'update', 'delete', 'options', 'listar', 'add', 'delete-local-armazem', 'editar' ],
            'allow' => true,
            'roles' => ['operario'] // se tirar o role, qualquer utilizar AUTENTICADO pode usar o serviço.
        ];

        return $behaviors;
    }

    public function actionListar(){
        $model = new LocalArmazemRest();
        $get = Yii::$app->request->get(); //esta linha de código vai buscar os parâmetros de query do REQUEST (ex: ?grau="licensiatura)
        $dataProvider = $model->dadosListar($get);

        return $dataProvider;
    }

    public function actionAdd(){
        $model = new LocalArmazemRest();
        $model->load(Yii::$app->request->post(), '');
        $model->save();
        return $model;
    }


    public function actionDeleteLocalArmazem(){
        $model =  LocalArmazemRest::find()->where(['id' => Yii::$app->request->post('id')])->one();
        $model->delete();
        return "Deletado com sucesso";
    }

    public function actionEditar(){
        $model = LocalArmazemRest::find()->where(['id' =>Yii::$app->request->post('id')])->one();
        $model->load(yii::$app->request->post(), '');
        $model->save();
        return $model;

    }
}