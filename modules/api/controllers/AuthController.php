<?php

namespace  app\modules\api\controllers;

use amnah\yii2\user\models\forms\LoginForm;
use amnah\yii2\user\models\Role;
use amnah\yii2\user\models\UserToken;
use app\models\User;
use Yii;
use yii\rest\Controller;
use yii\web\ServerErrorHttpException;

class AuthController extends Controller{

    public function verbs()
    {
        return [
            'register' => ['POST'],
            'login' => ['POST']
        ];
    }

    public function actionLogin(){

        $model = new LoginForm();
        $model->load(Yii::$app->request->post(),'');

        if($model->load(Yii::$app->request->post(),'') && $model->validate()){
            //throw new ServerErrorHttpException("Erro no envio dos dados");

            Yii::$app->user->login($model->getUser());
            return ['acess_token' => Yii::$app->user->identity->access_token];
        }else{

            $model->validate();
            return $model;
        }
    }

    public function actionRegister(){
        $user = new User();
        $user->scenario = "register";

        $post = Yii::$app->request->post();
        if(!$post){
            throw new ServerErrorHttpException("Erro no envio dos dados");
        }

        if($user->load($post, '')){

            if($user->validate()){
                // Os dados estão validados e na instância user

                $user->setRegisterAttributes(Role::ROLE_USER);
                $user->save();
                $this->afterRegister($user);
            }
        }

        return $user;
    }

    protected function afterRegister($user)
    {
        /** @var \amnah\yii2\user\models\UserToken $userToken */
        $userToken = new UserToken();

        // determine userToken type to see if we need to send email
        $userTokenType = null;
        if ($user->status == $user::STATUS_INACTIVE) {
            $userTokenType = $userToken::TYPE_EMAIL_ACTIVATE;
        } elseif ($user->status == $user::STATUS_UNCONFIRMED_EMAIL) {
            $userTokenType = $userToken::TYPE_EMAIL_CHANGE;
        }

        // check if we have a userToken type to process, or just log user in directly
        if ($userTokenType) {
            $userToken = $userToken::generate($user->id, $userTokenType);
            if (!$numSent = $user->sendEmailConfirmation($userToken)) {

                // handle email error
                //Yii::$app->session->setFlash("Email-error", "Failed to send email");
            }
        } else {
            Yii::$app->user->login($user, $this->module->loginDuration);
        }
    }
}
