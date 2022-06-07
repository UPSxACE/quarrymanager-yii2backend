<?php

namespace app\modules\api\models;

use app\models\Material;
use yii\data\ActiveDataProvider;

class MaterialRest extends Material
{
    public function fields(){
        return ['nome', 'prefixo'];
    }

    public function dadosListar($params){
        $query = MaterialRest::find();

        $dataProvider = new ActiveDataProvider([
            'query'=>$query,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        $this->load($params, "");

        return $dataProvider;
    }

}