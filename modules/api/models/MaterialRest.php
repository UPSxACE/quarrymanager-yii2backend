<?php

namespace app\modules\api\models;

use app\models\Cor;
use app\models\Material;

class MaterialRest extends Material
{

    public function fields(){
        return ['nome'];

    }

}