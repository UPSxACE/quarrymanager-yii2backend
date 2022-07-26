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
            'query'=>$query,
            'pagination' => [
                'pageSize' => 7,
            ],
        ]);

        $this->load($params, "");

        return $dataProvider;
    }


    public function fields(){
        return ['id', 'nome', 'coordenadasGPS_X', 'coordenadasGPS_Y'];
    }


}