<?php

namespace app\modules\api\controllers;


use app\modules\api\models\LocalArmazemRest;
use yii\rest\ActiveController;

class LocalArmazemController extends BaseController
{
    public $modelClass = LocalArmazemRest::class;
}