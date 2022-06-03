<?php

namespace app\modules\api\models;

use app\models\TipoAcao;


class TipoAcaoRest extends TipoAcao
{
    public function fields(){
        return ['nome'];
    }
}