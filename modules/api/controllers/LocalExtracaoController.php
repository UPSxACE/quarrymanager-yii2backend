<?php

namespace app\modules\api\controllers;

use app\models\Logs;
use app\modules\api\models\LocalExtracaoRest;
use app\modules\api\models\UserRest;
use Yii;


class LocalExtracaoController extends BaseController
{
    public $modelClass = LocalExtracaoRest::class;

    public function behaviors(){
        $behaviors = parent::behaviors();
        $behaviors['access']['rules'][] = [

            'actions' =>  ['index', 'view', 'create', 'update', 'delete', 'options', 'listar', 'add', 'delete-local-extracao', 'editar', 'find' ],
            'allow' => true,
            'roles' => ['gestor'] // se tirar o role, qualquer utilizar AUTENTICADO pode usar o serviço.
        ];

        return $behaviors;
    }

    public function actionListar(){
        $model = new LocalExtracaoRest();
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

        $model = new LocalExtracaoRest();
        $model->load(Yii::$app->request->post(), '');
        $model->save();
        Logs::registrarLogUser($user->id, 2, "O local de extração '" . $model->nome . "' foi criado.");
        return $model;
    }


    public function actionDeleteLocalExtracao(){
        $access_header = Yii::$app->request->headers->get("Authorization");
        $access_token = str_replace("Basic ", "", $access_header);
        $access_token = base64_decode($access_token);
        $access_token = str_replace(":", "", $access_token);
        $user = UserRest::findOne(["access_token"=>$access_token]);

        $model =  LocalExtracaoRest::find()->where(['id' => Yii::$app->request->get('id')])->one();
        $model->delete();
        Logs::registrarLogUser($user->id, 2, "O local de extração " . $model->codigo_lote . " foi eliminado.");
        return "Deletado com sucesso";
    }

    public function actionEditar(){
        $access_header = Yii::$app->request->headers->get("Authorization");
        $access_token = str_replace("Basic ", "", $access_header);
        $access_token = base64_decode($access_token);
        $access_token = str_replace(":", "", $access_token);
        $user = UserRest::findOne(["access_token"=>$access_token]);

        $model = LocalExtracaoRest::find()->where(['id' =>Yii::$app->request->post('id')])->one();
        $model->load(yii::$app->request->post(), '');
        $model->save();
        Logs::registrarLogUser($user->id, 2, "O local de extração " . $model->codigo_lote . " foi modificado.");
        return $model;

    }
    public function actionFind(){
        $model = LocalExtracaoRest::find()->where(['id'=>Yii::$app->request->get('id')])->one();
        return $model;
    }
}