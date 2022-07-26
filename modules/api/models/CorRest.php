<?php

namespace app\modules\api\models;

use app\models\Cor;
use yii\data\ActiveDataProvider;

class CorRest extends Cor
{


    public function fields(){
        return ['id', 'nome', 'prefixo'];
    }

    public function dadosListar($params){
        $query = CorRest::find();

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