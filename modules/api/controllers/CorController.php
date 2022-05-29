<?php

namespace app\modules\api\controllers;


use app\modules\api\models\CorRest;
use yii\rest\ActiveController;

class CorController extends BaseController
{
    public $modelClass = CorRest::class;
}