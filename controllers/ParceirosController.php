<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class EquipaController extends Controller
{
    public function actionIndex(){
        return $this->render('index');
    }

}

class ParceirosController
{

}