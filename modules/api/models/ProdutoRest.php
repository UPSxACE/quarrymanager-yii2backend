<?php

namespace app\modules\api\models;

use app\models\Produto;

class ProdutoRest extends Produto
{

    public function fields(){
        return [];
    }


    public function getIdMaterial0()
    {
        return $this->hasOne(MaterialRest::className(), ['id' => 'idMaterial']);
    }
}