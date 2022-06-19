<?php

namespace app\modules\api\controllers;


use app\models\Logs;
use app\modules\api\models\TransportadoraRest;
use app\modules\api\models\UserRest;
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
        $access_header = Yii::$app->request->headers->get("Authorization");
        $access_token = str_replace("Basic ", "", $access_header);
        $access_token = base64_decode($access_token);
        $access_token = str_replace(":", "", $access_token);
        $user = UserRest::findOne(["access_token" => $access_token]);

        $model = new TransportadoraRest();
        $model->load(Yii::$app->request->post(), '');
        $model->save();
        Logs::registrarLogUser($user->id, 3, "A transportadora" . $model->id . "' foi adicionada.");
        return $model;
    }


    public function actionDeleteTransportadora(){
        $access_header = Yii::$app->request->headers->get("Authorization");
        $access_token = str_replace("Basic ", "", $access_header);
        $access_token = base64_decode($access_token);
        $access_token = str_replace(":", "", $access_token);
        $user = UserRest::findOne(["access_token" => $access_token]);

        $model =  TransportadoraRest::find()->where(['id' => Yii::$app->request->get('id')])->one();
        $model->delete();
        Logs::registrarLogUser($user->id, 3, "A transportadora" . $model->id . "' foi eliminada.");
        return "Deletado com sucesso";
    }


    public function actionEditar(){
        $access_header = Yii::$app->request->headers->get("Authorization");
        $access_token = str_replace("Basic ", "", $access_header);
        $access_token = base64_decode($access_token);
        $access_token = str_replace(":", "", $access_token);
        $user = UserRest::findOne(["access_token" => $access_token]);

        $model = TransportadoraRest::find()->where(['id' =>Yii::$app->request->post('id')])->one();
        $model->load(yii::$app->request->post(), '');
        $model->save();
        Logs::registrarLogUser($user->id, 3, "A transportadora" . $model->id . "' foi modificada.");
        return $model;
    }
    public function actionFind(){
        $model = TransportadoraRest::find()->where(['id'=>Yii::$app->request->get('id')])->one();
        return $model;
    }
}

