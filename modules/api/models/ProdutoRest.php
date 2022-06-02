<?php

namespace app\modules\api\models;

use app\models\Produto;
use yii\data\ActiveDataProvider;

class ProdutoRest extends Produto
{

    public function fields(){
        return ['idMaterial0','na_loja', 'Res_Compressao', 'Res_Flexao', 'Massa_Vol_Aparente', 'Absorcao_Agua'];
    }


    public function getIdMaterial0()
    {
        return $this->hasOne(MaterialRest::className(), ['id' => 'idMaterial']);
    }

    public function dadosListar($params){
        $query = ProdutoRest::find();
            //->innerJoinWith('idProduto0.idMaterial0')
            //->innerJoinWith('idLocalExtracao0');
        //->joinWith(['idProduto0']);

        $dataProvider = new ActiveDataProvider([
            'query'=>$query
        ]);

        $this->load($params, "");
        /*
                $query->andFilterWhere([
                    'prefixo' => $this->prefixo
                ]);*/

        return $dataProvider;
    }
}