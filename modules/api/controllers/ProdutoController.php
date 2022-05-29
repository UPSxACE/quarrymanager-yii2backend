<?php

namespace app\modules\api\controllers;


use app\modules\api\models\ProdutoRest;
use yii\rest\ActiveController;

class ProdutoController extends BaseController
{
    public $modelClass = ProdutoRest::class;
}