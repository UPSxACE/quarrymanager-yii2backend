<?php

namespace app\modules\api\controllers;


use app\modules\api\models\LocalExtracaoRest;
use yii\rest\ActiveController;

class LocalExtracaoController extends BaseController
{
    public $modelClass = LocalExtracaoRest::class;
}