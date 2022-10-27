<?php

namespace app\controllers;

use amnah\yii2\user\models\UserToken;
use app\models\Fotografia;
use app\models\Profile;
use app\models\UploadForm;
use app\models\User;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

class PerfilController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex(){
        return $this->redirect(['meu-perfil']);
    }

    public function actionMeuPerfil(){
        $modelPerfil = new Profile();
        $modelPerfil = $modelPerfil->findPerfil(Yii::$app->user->identity->profile->user_id);
        $modelUpload = new UploadForm();

        if ($this->request->isPost) {
            //uploaded file save
            if (Yii::$app->request->isPost) {

                $modelPerfil->load($this->request->post());
                //$modelPerfil->user_id = Yii::$app->user->identity->profile->user_id;
                $modelUpload->imageFile = UploadedFile::getInstance($modelUpload, 'imageFile');
                if ($modelUpload->uploadProfilePicture()) {
                    //codigo NOVO
                    $modelFotografia = new Fotografia();
                    $modelFotografia->link = 'profilePictures/' . $modelUpload->imageFile->baseName . '.' . $modelUpload->imageFile->extension;
                    if(!$modelFotografia->save()){
                        //código para lidar com erro ao guardar imagem(irá ser feito futuramente)
                    } else {
                        $modelPerfil->idFotografia = $modelFotografia->id;
                        if(!$modelPerfil->save()){
                            //código para lidar com erro ao guardar imagem(irá ser feito futuramente)
                        }
                    }

                    Yii::$app->session->setFlash("Account-success", Yii::t("user", "Fotografia de perfil atualizada com sucesso."));
                    // file is uploaded successfully
                    return $this->render('meu-perfil',[
                        'modelPerfil' => $modelPerfil,
                        'modelUpload' => $modelUpload
                    ]);
                }
            }

            //return $this->render('upload', ['model' => $model]);

            //form save
            if ($modelPerfil->load($this->request->post()) && $modelPerfil->save()) {

                /*
                $userid = Yii::$app->user->identity->id;
                $username = Yii::$app->user->identity->username;
                */
                //\app\models\Logs::registrarLogUser($userid, 2, $username . " criou um novo Local de Extração."); //identificar id usuario automatico
                Yii::$app->session->setFlash("Account-success", Yii::t("user", "Dados da conta atualizados com sucesso."));
                return $this->redirect(['meu-perfil', [
                    'modelPerfil' => $modelPerfil,
                    'modelUpload' => $modelUpload
                ]]);
            }
        } else {
            //$modelPerfil->loadDefaultValues();
        }

        return $this->render('meu-perfil',[
            'modelPerfil' => $modelPerfil,
            'modelUpload' => $modelUpload
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

                    if($modelUser->newPassword !== $modelUser->newPasswordConfirm){
                        $modelDefinicoes->addError("newPassword", "Passwords do not match");
                        return $this->render('definicoes',[
                            'modelDefinicoes' => $modelDefinicoes
                        ]);
                    }

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
                    Yii::$app->session->setFlash("Account-success", Yii::t("user", "Definições da conta atualizados com sucesso."));

                    //return $this->refresh();

                    //recriar model
                    $modelDefinicoes->loadDefaultValues();

                    return $this->render('definicoes',[
                        'modelDefinicoes' => $modelDefinicoes
                    ]);
                } else { Yii::$app->session->setFlash("Account-fail", Yii::t("user", "Account not updated. Incorrect password.")); }
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