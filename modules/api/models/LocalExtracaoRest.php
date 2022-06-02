<?php

namespace app\modules\api\models;

use app\models\LocalExtracao;

class LocalExtracaoRest extends LocalExtracao
{
    public function fields(){
        return ['coordenadasGPS_X', 'coordenadasGPS_Y', 'nome'];
    }
}