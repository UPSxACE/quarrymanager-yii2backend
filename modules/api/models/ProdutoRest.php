<?php

namespace app\modules\api\models;

use app\models\Cor;
use app\models\Material;
use app\models\Produto;
use yii\data\ActiveDataProvider;

class ProdutoRest extends Produto
{/*
    const SCENARIO_LOJA = 'loja';

    public function scenarios()
    {
        return [
            self::SCENARIO_LOJA => ['tituloArtigo', 'idMaterial0', 'idCor0', 'preco'],
        ];
    }*/

    public function dadosListar($params)
    {
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

        return ['tituloArtigo','na_loja', 'Res_Compressao', 'Res_Flexao', 'Massa_Vol_Aparente', 'Absorcao_Agua', 'idMaterial0', 'idCor0', 'preco' ];

        /*
                switch ($this->scenario) {
                    case 'loja':
                        return ['tituloArtigo', 'idMaterial0', 'idCor0', 'preco'  ];

            default:
                return ['idMaterial0','na_loja', 'Res_Compressao', 'Res_Flexao', 'Massa_Vol_Aparente', 'Absorcao_Agua', ];
        }*/
    }


    public function getIdMaterial0()
    {
        return $this->hasOne(MaterialRest::className(), ['id' => 'idMaterial']);
    }



    public function getIdCor0()
    {
        return $this->hasOne(CorRest::className(), ['id' => 'idCor']);
    }

}