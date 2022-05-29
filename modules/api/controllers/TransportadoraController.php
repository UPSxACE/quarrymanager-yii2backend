<?php

namespace app\modules\api\controllers;


use app\modules\api\models\TransportadoraRest;
use yii\rest\ActiveController;

class TransportadoraController extends BaseController
{
    public $modelClass = TransportadoraRest::class;
}