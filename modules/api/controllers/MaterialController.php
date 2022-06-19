<?php

namespace app\modules\api\controllers;


use app\models\Logs;
use app\modules\api\models\MaterialRest;
use app\modules\api\models\UserRest;
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
        $access_header = Yii::$app->request->headers->get("Authorization");
        $access_token = str_replace("Basic ", "", $access_header);
        $access_token = base64_decode($access_token);
        $access_token = str_replace(":", "", $access_token);
        $user = UserRest::findOne(["access_token"=>$access_token]);

        $model = new MaterialRest();
        $model->load(Yii::$app->request->post(), '');
        $model->save();
        Logs::registrarLogUser($user->id, 2, "O produto de ID #" . $model->id . " foi criado.");
        return $model;
    }

    public function actionDeleteMaterial(){
        $access_header = Yii::$app->request->headers->get("Authorization");
        $access_token = str_replace("Basic ", "", $access_header);
        $access_token = base64_decode($access_token);
        $access_token = str_replace(":", "", $access_token);
        $user = UserRest::findOne(["access_token"=>$access_token]);

        if (Yii::$app->request->get('prefixo')){

            $model = MaterialRest::find()->where(['prefixo' => Yii::$app->request->get('prefixo')])->one();

        }
        else{
            $model = MaterialRest::find()->where(['id' => Yii::$app->request->get('id')])->one();

        }

        $model->delete();
        Logs::registrarLogUser($user->id, 2, "O Produto de ID #" . $model->codigo_lote . " foi eliminado.");
        return "Deletado com sucesso";
    }

    public function actionEditar(){
        $access_header = Yii::$app->request->headers->get("Authorization");
        $access_token = str_replace("Basic ", "", $access_header);
        $access_token = base64_decode($access_token);
        $access_token = str_replace(":", "", $access_token);
        $user = UserRest::findOne(["access_token"=>$access_token]);

        $model = MaterialRest::find()->where(['id' =>Yii::$app->request->post('id')])->one();
        $model->load(yii::$app->request->post(), '');
        $model->save();
        Logs::registrarLogUser($user->id, 2, "O Produto de ID #" . $model->codigo_lote . " foi modificado.");
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