<?php

namespace app\controllers;

use amnah\yii2\user\models\UserToken;
use app\models\Profile;
use app\models\User;
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
        $modelDefinicoes = Yii::$app->user->identity;
        $modelDefinicoes->setScenario("account");


        if ($this->request->isPost) {

            if ($modelDefinicoes->load($this->request->post())) {

                //visto que o identity não está a permitir criar um novo método...
                $modelUser = new User();
                $modelUser->load($this->request->post());

                $userToken = new \amnah\yii2\user\models\UserToken();
                if($modelUser->validateCurrentPasswordReturn($modelDefinicoes->currentPassword)){

                    // check if user changed his email
                    $newEmail = $modelDefinicoes->email != Yii::$app->user->identity->email;
                    if ($newEmail) {
                        $userToken = $userToken::generate($modelDefinicoes->id, $userToken::TYPE_EMAIL_CHANGE, $newEmail);
                        if (!$numSent = $modelDefinicoes->sendEmailConfirmation($userToken)) {

                            // handle email error
                            Yii::$app->session->setFlash("Email-error", "Failed to send email");
                        }
                    }

                    $modelDefinicoes->save(false);
                    Yii::$app->session->setFlash("Account-success", Yii::t("user", "Account updated"));


                    //return $this->refresh();

                    //recriar model
                    $modelDefinicoes->loadDefaultValues();

                    return $this->render('definicoes',[
                        'modelDefinicoes' => $modelDefinicoes
                    ]);
                }


            }
        }

        return $this->render('definicoes',[
            'modelDefinicoes' => $modelDefinicoes
        ]);
    }

    public function actionHistorico(){
        return $this->render('historico');
    }
}