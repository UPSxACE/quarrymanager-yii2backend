<?php

namespace app\modules\api\controllers;
use app\modules\api\models\StatsRest;
use Yii;


class HomeController extends BaseController
{
    public $modelClass = StatsRest::class;

    public function behaviors(){
        $behaviors = parent::behaviors();
        $behaviors['access']['rules'][] = [
            'actions' =>  ['index', 'view', 'create', 'update', 'delete', 'options', 'stats' ],
            'allow' => true,
            'roles' => ['operario'] // se tirar o role, qualquer utilizar AUTENTICADO pode usar o serviço.
        ];

        return $behaviors;
    }

    public function actionStats(){
        $model = new StatsRest();
        $get = Yii::$app->request->get(); //esta linha de código vai buscar os parâmetros de query do REQUEST (ex: ?grau="licensiatura)
        $dataProvider = $model->cardStats($get);

        return $dataProvider;
    }

}