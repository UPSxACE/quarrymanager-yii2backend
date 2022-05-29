<?php

namespace app\modules\api\controllers;


use app\modules\api\models\MaterialRest;
use yii\rest\ActiveController;

class MaterialController extends BaseController
{
    public $modelClass = MaterialRest::class;
}