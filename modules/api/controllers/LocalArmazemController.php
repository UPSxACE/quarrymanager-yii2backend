<?php

namespace app\modules\api\controllers;


use app\models\Logs;
use app\modules\api\models\LocalArmazemRest;
use app\modules\api\models\UserRest;
use Yii;


class LocalArmazemController extends BaseController
{
    public $modelClass = LocalArmazemRest::class;

    public function behaviors(){
        $behaviors = parent::behaviors();
        $behaviors['access']['rules'][] = [

            'actions' =>  ['index', 'view', 'create', 'update', 'delete', 'options', 'listar', 'add', 'delete-local-armazem', 'editar', 'find' ],
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
        $access_header = Yii::$app->request->headers->get("Authorization");
        $access_token = str_replace("Basic ", "", $access_header);
        $access_token = base64_decode($access_token);
        $access_token = str_replace(":", "", $access_token);
        $user = UserRest::findOne(["access_token"=>$access_token]);

        $model = new LocalArmazemRest();
        $model->load(Yii::$app->request->post(), '');
        $model->save();
        Logs::registrarLogUser($user->id, 2, "O local de armazém '" . $model->nome . "' foi criado.");
        return $model;
    }


    public function actionDeleteLocalArmazem(){
        $access_header = Yii::$app->request->headers->get("Authorization");
        $access_token = str_replace("Basic ", "", $access_header);
        $access_token = base64_decode($access_token);
        $access_token = str_replace(":", "", $access_token);
        $user = UserRest::findOne(["access_token"=>$access_token]);

        $model =  LocalArmazemRest::find()->where(['id' => Yii::$app->request->post('id')])->one();
        $model->delete();
        Logs::registrarLogUser($user->id, 2, "O local de armazém " . $model->codigo_lote . " foi apagado.");
        return "Deletado com sucesso";
    }

    public function actionEditar(){
        $access_header = Yii::$app->request->headers->get("Authorization");
        $access_token = str_replace("Basic ", "", $access_header);
        $access_token = base64_decode($access_token);
        $access_token = str_replace(":", "", $access_token);
        $user = UserRest::findOne(["access_token"=>$access_token]);

        $model = LocalArmazemRest::find()->where(['id' =>Yii::$app->request->post('id')])->one();
        $model->load(yii::$app->request->post(), '');
        $model->save();
        Logs::registrarLogUser($user->id, 2, "O local de armazém " . $model->codigo_lote . " foi modificado.");
        return $model;

    }
    public function actionFind(){
        $model = LocalArmazemRest::find()->where(['id'=>Yii::$app->request->get('id')])->one();
        return $model;
    }
}