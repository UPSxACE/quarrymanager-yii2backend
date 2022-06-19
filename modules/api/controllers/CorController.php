<?php

namespace app\modules\api\controllers;


use app\models\Logs;
use app\modules\api\models\CorRest;
use app\modules\api\models\LoteRest;
use app\modules\api\models\UserRest;
use Yii;
use yii\rest\ActiveController;

class CorController extends BaseController
{
    public $modelClass = CorRest::class;

    public function behaviors(){
        $behaviors = parent::behaviors();
        $behaviors['access']['rules'][] = [

            'actions' =>  ['index', 'view', 'create', 'update', 'delete', 'options', 'listar', 'add', 'delete-cor','editar','find'  ],
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


    public function actionAdd(){
        $access_header = Yii::$app->request->headers->get("Authorization");
        $access_token = str_replace("Basic ", "", $access_header);
        $access_token = base64_decode($access_token);
        $access_token = str_replace(":", "", $access_token);
        $user = UserRest::findOne(["access_token"=>$access_token]);

        $model = new CorRest();
        $model->load(Yii::$app->request->post(), '');
        $model->save();
        Logs::registrarLogUser($user->id, 2, "A cor '" . $model->nome . "' foi criada.");
        return $model;
    }

    public function actionDeleteCor(){
        $access_header = Yii::$app->request->headers->get("Authorization");
        $access_token = str_replace("Basic ", "", $access_header);
        $access_token = base64_decode($access_token);
        $access_token = str_replace(":", "", $access_token);
        $user = UserRest::findOne(["access_token"=>$access_token]);

        if (Yii::$app->request->post('prefixo')){

            $model =  CorRest::find()->where(['prefixo' => Yii::$app->request->post('prefixo')])->one();

        }
        else{
            $model = CorRest::find()->where(['id' => Yii::$app->request->post('id')])->one();

        }

        $model->delete();
        Logs::registrarLogUser($user->id, 2, "A cor" . $model->codigo_lote . " foi eliminada.");
        return "Deletado com sucesso";
    }

    public function actionEditar(){
        $access_header = Yii::$app->request->headers->get("Authorization");
        $access_token = str_replace("Basic ", "", $access_header);
        $access_token = base64_decode($access_token);
        $access_token = str_replace(":", "", $access_token);
        $user = UserRest::findOne(["access_token"=>$access_token]);

        $model = CorRest::find()->where(['id' =>Yii::$app->request->post('id')])->one();
        $model->load(yii::$app->request->post(), '');
        $model->save();
        Logs::registrarLogUser($user->id, 2, "A cor" . $model->codigo_lote . " foi modificada.");
        return $model;
    }


    public function actionFind(){
        if (Yii::$app->request->post('prefixo')){

            $model =  CorRest::find()->where(['prefixo' => Yii::$app->request->get('prefixo')])->one();

        }
        else{
            $model = CorRest::find()->where(['id' => Yii::$app->request->get('id')])->one();

        }


        return $model;
    }
}