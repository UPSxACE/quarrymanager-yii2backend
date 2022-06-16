<?php

namespace app\modules\api\controllers;


use app\modules\api\models\MaterialRest;
use Yii;
use yii\rest\ActiveController;

class MaterialController extends BaseController
{
    public $modelClass = MaterialRest::class;

    public function behaviors(){
        $behaviors = parent::behaviors();
        $behaviors['access']['rules'][] = [

            'actions' =>  ['index', 'view', 'create', 'update', 'delete', 'options', 'listar', 'add', 'delete-material', 'editar', 'find' ],
            'allow' => true,
            'roles' => ['operario'] // se tirar o role, qualquer utilizar AUTENTICADO pode usar o serviço.
        ];

        return $behaviors;
    }

    public function actionListar(){
        $model = new MaterialRest();
        $get = Yii::$app->request->get(); //esta linha de código vai buscar os parâmetros de query do REQUEST (ex: ?grau="licensiatura)
        $dataProvider = $model->dadosListar($get);

        return $dataProvider;
    }


    public function actionAdd(){
        $model = new MaterialRest();
        $model->load(Yii::$app->request->post(), '');
        $model->save();
        return $model;
    }

    public function actionDeleteMaterial(){

        if (Yii::$app->request->post('prefixo')){

            $model = MaterialRest::find()->where(['prefixo' => Yii::$app->request->post('prefixo')])->one();

        }
        else{
            $model = MaterialRest::find()->where(['id' => Yii::$app->request->post('id')])->one();

        }

        $model->delete();
        return "Deletado com sucesso";
    }

    public function actionEditar(){
        $model = MaterialRest::find()->where(['id' =>Yii::$app->request->post('id')])->one();
        $model->load(yii::$app->request->post(), '');
        $model->save();
        return $model;
    }
    public function actionFind()
    {
        if (Yii::$app->request->post('prefixo')) {
            $model = MaterialRest::find()->where(['prefixo' => Yii::$app->request->get('prefixo')])->one();
        } else {
            $model = MaterialRest::find()->where(['id' => Yii::$app->request->get('id')])->one();
        }
        return $model;
    }
}