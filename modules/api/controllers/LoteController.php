<?php

namespace app\modules\api\controllers;


use app\models\Logs;
use app\modules\api\models\LoteRest;
use app\modules\api\models\UserRest;
use Yii;
use yii\rest\ActiveController;

class LoteController extends BaseController
{
    public $modelClass = LoteRest::class;

    public function behaviors(){
        $behaviors = parent::behaviors();
        $behaviors['access']['rules'][] = [

            'actions' =>  ['index', 'view', 'create', 'update', 'delete', 'options', 'listar', 'add', 'delete-lote', 'editar' , 'find' ],
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
        $access_header = Yii::$app->request->headers->get("Authorization");
        $access_token = str_replace("Basic ", "", $access_header);
        $access_token = base64_decode($access_token);
        $access_token = str_replace(":", "", $access_token);
        $user = UserRest::findOne(["access_token"=>$access_token]);

        $model = new LoteRest();
        $model->load(Yii::$app->request->post(), '');
        $model->save();
        Logs::registrarLogUser($user->id, 2, "O lote " . $model->codigo_lote . " foi adicionado.");

        return $model;
    }

    public function actionDeleteLote(){


        $model =  LoteRest::find()->where(['codigo_lote' => Yii::$app->request->post('codigo_lote')])->one();

        $model->delete();
        return "Deletado com sucesso";
    }

    public function actionEditar(){

        $access_header = Yii::$app->request->headers->get("Authorization");
        $access_token = str_replace("Basic ", "", $access_header);
        $access_token = base64_decode($access_token);
        $access_token = str_replace(":", "", $access_token);
        $user = UserRest::findOne(["access_token"=>$access_token]);

        $model = LoteRest::find()->where(['codigo_lote' =>Yii::$app->request->post('codigo_lote')])->one();
        $model->load(yii::$app->request->post(), '');
        $model->save();
        Logs::registrarLogUser($user->id, 2, "O Produto de ID #" . $model->codigo_lote . " foi modificado.");
        return $model;
    }

    public function actionFind(){
        $model = LoteRest::find()->where(['codigo_lote'=>Yii::$app->request->get('codigo_lote')])->one();
        return $model;
    }
}