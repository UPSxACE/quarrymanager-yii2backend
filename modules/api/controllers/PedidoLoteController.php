<?php

namespace app\modules\api\controllers;


use app\models\Logs;
use app\modules\api\models\MaterialRest;
use app\modules\api\models\PedidoLoteRest;
use app\modules\api\models\UserRest;
use Yii;
use yii\rest\ActiveController;

class PedidoLoteController extends BaseController
{
    public $modelClass = PedidoLoteRest::class;

    public function behaviors(){
        $behaviors = parent::behaviors();
        $behaviors['access']['rules'][] = [
            'actions' =>  ['index', 'view', 'create', 'update', 'delete', 'options' ],
            'allow' => true,
            'roles' => ['operario'] // se tirar o role, qualquer utilizar AUTENTICADO pode usar o serviço.
        ];

        return $behaviors;
    }

    public function actionAdd(){
        $access_header = Yii::$app->request->headers->get("Authorization");
        $access_token = str_replace("Basic ", "", $access_header);
        $access_token = base64_decode($access_token);
        $access_token = str_replace(":", "", $access_token);
        $user = UserRest::findOne(["access_token" => $access_token]);

        $model = new PedidoLoteRest();
        $model->load(Yii::$app->request->post(), '');
        $model->save();
        Logs::registrarLogUser($user->id, 2, "O prodido" . $model->id . " foi criado.");
        return $model;
    }

    public function actionEditar(){
        $access_header = Yii::$app->request->headers->get("Authorization");
        $access_token = str_replace("Basic ", "", $access_header);
        $access_token = base64_decode($access_token);
        $access_token = str_replace(":", "", $access_token);
        $user = UserRest::findOne(["access_token"=>$access_token]);

        $model = PedidoLoteRest::find()->where(['id' =>Yii::$app->request->post('id')])->one();
        $model->load(yii::$app->request->post(), '');
        $model->save();
        Logs::registrarLogUser($user->id, 2, "O prodido" . $model->codigo_lote . " foi modificado.");
        return $model;
    }
}