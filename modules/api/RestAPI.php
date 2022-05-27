<?php

namespace app\modules\api;
use Yii;
use yii\base\Module;

class RestAPI extends Module {

    /*
    public function api()
    {
        parent::api();
    }*/

    public function init(){
        parent::init();
        Yii::$app->user->enableSession = false;
    }
};

