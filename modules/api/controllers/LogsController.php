<?php

namespace app\modules\api\controllers;


use app\modules\api\models\LogsRest;
use yii\rest\ActiveController;

class LogsController extends BaseController
{
    public $modelClass = LogsRest::class;
}