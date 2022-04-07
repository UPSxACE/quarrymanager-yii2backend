<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class PerfilController extends Controller
{
    public function actionIndex(){
        return $this->redirect(['meu-perfil']);
    }

    public function actionMeuPerfil(){
        $modelPerfil = new Profile();

        return $this->render('meu-perfil');
    }

    public function actionDefinicoes(){
        return $this->render('definicoes');
    }

    public function actionHistorico(){
        return $this->render('historico');
    }
}