<?php

namespace app\modules\api\controllers;


use app\modules\api\models\LoteRest;
use yii\rest\ActiveController;

class LoteController extends BaseController
{
    public $modelClass = LoteRest::class;
}