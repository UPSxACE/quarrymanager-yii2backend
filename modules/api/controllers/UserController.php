<?php

namespace app\modules\api\controllers;


use app\modules\api\models\TransportadoraRest;
use app\modules\api\models\UserRest;
use Yii;
use yii\rest\ActiveController;

class UserController extends BaseController
{
    public $modelClass = UserRest::class;

    public function behaviors(){
        $behaviors = parent::behaviors();
        $behaviors['access']['rules'][] = [
            'actions' =>  ['index', 'view', 'create', 'update', 'delete', 'options', 'listar', 'find' ],
            'allow' => true,
            'roles' => ['operario'] // se tirar o role, qualquer utilizar AUTENTICADO pode usar o serviço.
        ];

        return $behaviors;
    }

    public function actionListar(){
        $model = new UserRest();
        $get = Yii::$app->request->get(); //esta linha de código vai buscar os parâmetros de query do REQUEST (ex: ?grau="licensiatura)
        $dataProvider = $model->dadosListar($get);

        return $dataProvider;
    }

    public function actionFind()
    {
        if (Yii::$app->request->get('username')) {
            $model = UserRest::find()->where(['username' => Yii::$app->request->get('username')])->one();
        } elseif (Yii::$app->request->get('email')){
            $model = UserRest::find()->where(['email' => Yii::$app->request->get('email')])->one();
        } else {
            $model = UserRest::find()->where(['id' => Yii::$app->request->get('id')])->one();
        }
        return $model;
    }
}