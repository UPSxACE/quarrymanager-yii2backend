<?php

namespace app\modules\api\models;

use app\models\Cor;
use app\models\Material;
use app\models\Produto;
use yii\data\ActiveDataProvider;

class ProdutoRest extends Produto
{


    public function dadosListar($params){
        $query = ProdutoRest::find();
        //  ->innerJoinWith('idCor0');
        //->joinWith(['idMaterial0']);


        $dataProvider = new ActiveDataProvider([
            'query'=>$query
        ]);

        $this->load($params, "");

        return $dataProvider;
    }

    public function fields(){
        return ['tituloArtigo', 'idMaterial0', 'idCor0', 'preco'  ];

    }

    public function getIdCor0()
    {
        return $this->hasOne(CorRest::className(), ['id' => 'idCor']);
    }

    public function getIdMaterial0()
    {
        return $this->hasOne(MaterialRest::className(), ['id' => 'idMaterial']);
    }


}