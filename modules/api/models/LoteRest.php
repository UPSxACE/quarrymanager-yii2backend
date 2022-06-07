<?php

namespace app\modules\api\models;

use app\models\Lote;
use yii\data\ActiveDataProvider;

class LoteRest extends Lote
{


    public function fields(){
        return ['codigo_lote', 'quantidade', 'dataHora','idProduto0', 'idLocalExtracao0'];
    }

    public function dadosListar($params){
        $query = LoteRest::find();
        //->joinWith(['idProduto0']);

        $dataProvider = new ActiveDataProvider([
            'query'=>$query,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        $this->load($params, "");
/*
        $query->andFilterWhere([
            'prefixo' => $this->prefixo
        ]);*/

        return $dataProvider;
    }


    public function getIdProduto0()
    {
        return $this->hasOne(ProdutoRest::className(), ['id' => 'idProduto']);
    }

    public function getIdLocalExtracao0()
    {
        return $this->hasOne(LocalExtracaoRest::className(), ['id' => 'idLocalExtracao']);
    }
}