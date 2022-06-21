<?php

namespace app\modules\api\models;

use app\models\Transportadora;
use yii\data\ActiveDataProvider;

class TransportadoraRest extends Transportadora
{
    public function fields(){
        return ['id', 'nome'];
    }

    public function dadosListar($params){
        $query = TransportadoraRest::find();

        $dataProvider = new ActiveDataProvider([
            'query'=>$query,
            'pagination' => [
                'pageSize' => 7,
            ],
        ]);

        $this->load($params, "");


        return $dataProvider;
    }
}