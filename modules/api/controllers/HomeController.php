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
        $encomendaPendente = StatsRest::calcular(1);
        $encomendaConfirmada = StatsRest::calcular(3);
        $encomendaFinalizada = StatsRest::calcular(9);
        $encomendaCancelada = StatsRest::calcular(10);
        $financas = 5000;

        return ['pendentes' => $encomendaPendente, 'confirmados' => $encomendaConfirmada, 'finalizados' => $encomendaFinalizada, 'cancelados' => $encomendaCancelada, 'financas' => $financas];
    }
}