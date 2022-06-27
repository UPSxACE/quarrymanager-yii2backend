<?php

namespace app\controllers;

use app\models\Lote;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;


class CriadoresController extends Controller{
    public function actionIndex(){
        return $this->render('index');
    }
}

