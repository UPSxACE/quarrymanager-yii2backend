<?php

namespace app\modules\api\models;

use app\models\Logs;

class LogsRest extends Logs
{
    public function extraFields(){
        //return ['idUser0'];
    }
}