<?php

namespace app\modules\api\models;

use app\models\LocalExtracao;
use yii\data\ActiveDataProvider;

class LocalExtracaoRest extends LocalExtracao
{
    public function dadosListar($params){
        $query = LocalExtracaoRest::find();
        //  ->innerJoinWith('idCor0');
        //->joinWith(['idMaterial0']);


        $dataProvider = new ActiveDataProvider([
            'query'=>$query
        ]);

        $this->load($params, "");

        return $dataProvider;
    }


    public function fields(){
        return ['nome', 'coordenadasGPS_X', 'coordenadasGPS_Y'];

    }
}