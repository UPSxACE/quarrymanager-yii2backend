<?php

namespace app\modules\api\models;

use app\models\EstadoPedido;
use yii\data\ActiveDataProvider;


class StatsRest extends EstadoPedido
{
    public function cardStats($params){
        $query = StatsRest::find()->where(['last' => '1']);



        $dataProvider = new ActiveDataProvider([
            'query'=>$query,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        $this->load($params, "");

        return $dataProvider;
    }


    public function fields(){
        return ['id'];

    }

}