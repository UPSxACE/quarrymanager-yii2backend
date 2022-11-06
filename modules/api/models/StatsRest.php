<?php

namespace app\modules\api\models;

use app\models\EstadoPedido;
use yii\data\ActiveDataProvider;


class StatsRest extends EstadoPedido
{
    /*
    public function cardStats($params){
        $query = StatsRest::find()->where(['last' => '1']);



        $dataProvider = new ActiveDataProvider([
            'query'=>$query,
            'pagination' => [
                'pageSize' => 7,
            ],
        ]);

        $this->load($params, "");

        return $dataProvider;
    }*/


    public function fields(){
        return ['encomendas_pendentes' => function($model) {

            return $model->calcular(1);


        }];

    }


    public static function calcular($idEstado){
        return EstadoPedido::find()->andWhere(['idEstado' => $idEstado])->andWhere(['last' => '1'])->count();
        // return
    }
}