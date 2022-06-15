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
            'actions' =>  ['index', 'view', 'create', 'update', 'delete', 'options', 'listar', 'add', 'delete-material' ],
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

        if (isset($_GET['prefixo'])){

            $model =  MaterialRest::find()->where(['prefixo' => $_GET['prefixo']])->one();

        }
        else{
            $model = MaterialRest::find()->where(['id' => $_GET['id']])->one();

        }

        $model->delete();
        return "Deletado com sucesso";
    }
}