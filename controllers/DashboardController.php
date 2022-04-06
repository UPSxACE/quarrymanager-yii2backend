<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class DashboardController extends Controller
{
    public function actionIndex(){
        return $this->redirect(['home']);
    }

    public function actionHome(){
        return $this->render('home');
    }

}