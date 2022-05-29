<?php

namespace app\modules\api\models;

use app\models\Produto;

class ProdutoRest extends Produto
{
    public function extraFields(){
        //return ['idUser0'];
    }
}