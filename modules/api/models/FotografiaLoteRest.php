<?php

namespace app\modules\api\models;

use app\models\FotografiaLote;

class FotografiaLoteRest extends FotografiaLote
{
    public function fields(){
        return ['codigoLote', 'idFotografia', 'idFotografia0'];
    }
}