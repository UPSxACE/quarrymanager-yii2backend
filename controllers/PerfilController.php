<?php

namespace app\controllers;

use app\models\Profile;
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

        if ($this->request->isPost) {
            if ($modelPerfil->load($this->request->post()) && $modelPerfil->save()) {

                /*
                $userid = Yii::$app->user->identity->id;
                $username = Yii::$app->user->identity->username;
                */
                //\app\models\Logs::registrarLogUser($userid, 2, $username . " criou um novo Local de Extração."); //identificar id usuario automatico
                return $this->redirect(['meu-perfil', [
                    'modelPerfil' => $modelPerfil
                ]]);
            }
        } else {
            //$modelPerfil->loadDefaultValues();
        }

        return $this->render('meu-perfil',[
            'modelPerfil' => $modelPerfil
        ]);
    }

    public function actionDefinicoes(){
        return $this->render('definicoes');
    }

    public function actionHistorico(){
        return $this->render('historico');
    }
}