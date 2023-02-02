<?php

namespace  app\modules\api\controllers;

use amnah\yii2\user\models\forms\LoginForm;
use app\models\Role;
use amnah\yii2\user\models\UserToken;
use app\models\Profile;
use app\models\User;
use app\modules\api\models\UserRest;
use Yii;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\httpclient\Client;
use yii\rest\Controller;
use yii\web\ServerErrorHttpException;

class AuthController extends Controller{
public function verbs()
    {
        return [
            'register' => ['POST', 'OPTIONS'],
            'login' => ['POST', 'OPTIONS'],
            'refresh-token' => ['GET', 'OPTIONS']
        ];
    }

    public function behaviors()
    {
        $behaviors = parent::behaviors();

        unset($behaviors['authenticator']);

        $behaviors['corsFilter'] = [
            'class' => \yii\filters\Cors::class,
            'cors' => [
                'Origin' => ['*'],
                'Access-Control-Request-Headers' => ['*'],
            ],
        ];
        $behaviors['authenticator'] = [
            'class' => CompositeAuth::class,
            'authMethods' => [
                HttpBasicAuth::class,
                HttpBearerAuth::class //mecanismo de autenticação que o JWT vai utilizar
            ]
        ];
        $behaviors['authenticator']['except'] = ['options', 'login', 'register', 'check-permission'];

        /*
        $behaviors['access'] = [
            'class' => AccessControl::className(),
            'rules' => [
                /*[
                    'actions' => ['home', 'index', 'lotes', 'novo-lote', 'lotes-action', 'update-lote', 'delete-lote', 'stock',
                        'produtos', 'novo-produto', 'materiais', 'novo-material', 'cores', 'nova-cor', 'encomendas', 'encomendas-action',
                        'encomendas-mobilizacao', 'encomendas-agendar', 'confirmar-recolha'],
                    'allow' => true,
                    'roles' => ['operario'],
                ],*/
        /*],
        'denyCallback' => function ($rule, $action) {
            throw new ForbiddenHttpException("You're not allowed to access");
        }];*/

        return $behaviors;

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
        /*
        if(!$post){
            throw new ServerErrorHttpException("Erro no envio dos dados");
        }*/

        if($user->load($post, '')){

            if($user->validate()){
                // Os dados estão validados e na instância user
                $user->setRegisterAttributes(Role::ROLE_USER);
                if($user->save()){
                    $this->afterRegister($user, $post);
                    return $user->access_token;
                }

            }
        }

        return $user;
    }

    public function actionRefreshToken(){
        $access_header = Yii::$app->request->headers->get("Authorization");
        $access_token = str_replace("Basic ", "", $access_header);
        $access_token = base64_decode($access_token);
        $access_token = str_replace(":", "", $access_token);
        $user = UserRest::findOne(["access_token"=>$access_token]);

        $push_token = Yii::$app->request->get("push_token");

        if($push_token){
            $client = new Client();
            $response = $client->createRequest()
                ->setMethod("PUT")
                ->setFormat(Client::FORMAT_JSON)
                ->setUrl("https://ds3-gestorapedreira-default-rtdb.europe-west1.firebasedatabase.app/users/user_" . $user->id . "/push_token.json")
                ->setData($push_token)
                ->send();
            return $response;
        }
        return null;

    }

    protected function afterRegister($user, $post)
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

        //codigo de registrar perfil
        $profileModel = new Profile();
        $profileModel->load($post,'');
        $profileModel->user_id = $user->id;
        $profileModel->idFotografia = 1;
        $profileModel->created_at = date('Y-m-d H:i:s');
        $profileModel->updated_at = date('Y-m-d H:i:s');
        if($profileModel->validate()) {
            $profileModel->save();
        }

    }

    public function actionCheckPermission(){
        $access_header = Yii::$app->request->headers->get("Authorization");

        $access_token = str_replace("Basic ", "", $access_header);
        $access_token = base64_decode($access_token);
        $access_token = str_replace(":", "", $access_token);

        $permission = Yii::$app->request->get("permission");
        $user = UserRest::findOne(["access_token"=>$access_token]);


        if ($user !== null && $user->can($permission)) {
            return true;
        }

        return false;
    }

}
