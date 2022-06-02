<?php

namespace app\modules\api\models;

use app\models\Cor;

class CorRest extends Cor
{
    public function fields(){
        return ['nome'];

    }

}