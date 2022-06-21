<?php

namespace app\modules\api\models;

use app\models\Cor;
use app\models\Estado;
use yii\data\ActiveDataProvider;

class EstadoRest extends Estado
{
    public function fields(){
        return ['nome'];
    }

    public function dadosListar($params){
        $query = EstadoRest::find();

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