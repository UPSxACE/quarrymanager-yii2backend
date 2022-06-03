<?php

namespace app\modules\api\models;

use app\models\LocalArmazem;
use yii\data\ActiveDataProvider;

class LocalArmazemRest extends LocalArmazem
{
    public function dadosListar($params){
        $query = LocalArmazemRest::find();
        //  ->innerJoinWith('idCor0');
        //->joinWith(['idMaterial0']);


        $dataProvider = new ActiveDataProvider([
            'query'=>$query
        ]);

        $this->load($params, "");

        return $dataProvider;
    }


    public function fields(){
        return ['nome'];

    }
}