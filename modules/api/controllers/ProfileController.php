<?php

namespace app\modules\api\controllers;


use app\models\Fotografia;
use app\models\Profile;
use app\models\UploadForm;
use app\modules\api\models\ProfileRest;
use app\modules\api\models\UserRest;
use Yii;
use yii\db\Exception;
use yii\helpers\FileHelper;
use yii\rest\ActiveController;
use yii\web\ForbiddenHttpException;

class ProfileController extends BaseController
{
    public $modelClass = ProfileRest::class;

    public function behaviors(){
        $behaviors = parent::behaviors();
        $behaviors['access']['rules'][] = [
            'actions' =>  ['index', 'view', 'options', 'get-profile', 'test-image-upload', 'editar', 'editar-definicoes-perfil', 'get-profile-definicoes' ],
            'allow' => true,
            'roles' => ['@'] // se tirar o role, qualquer utilizar AUTENTICADO pode usar o serviço.
        ];
        $behaviors['access']['rules'][] = [
            'actions' =>  [ 'create', 'update', 'delete' ],
            'allow' => true,
            'roles' => ['gestor'] // se tirar o role, qualquer utilizar AUTENTICADO pode usar o serviço.
        ];

        return $behaviors;
    }

    public function actionGetProfile(){
        $access_header = Yii::$app->request->headers->get("Authorization");

        $access_token = str_replace("Basic ", "", $access_header);
        $access_token = base64_decode($access_token);
        $access_token = str_replace(":", "", $access_token);

        $user = UserRest::findOne(["access_token"=>$access_token]);
        $profile = ProfileRest::findOne(["user_id"=>$user->id]);
        return(
            $profile
        );
    }

    public function actionGetProfileDefinicoes(){
        $access_header = Yii::$app->request->headers->get("Authorization");

        $access_token = str_replace("Basic ", "", $access_header);
        $access_token = base64_decode($access_token);
        $access_token = str_replace(":", "", $access_token);

        $user = UserRest::findOne(["access_token"=>$access_token]);
        return(["username" => $user->username, "email" => $user->email]);
    }

    /*
    public function actionTestImageUpload(){

        $response = \Yii::$app->response;
        $response->format = yii\web\Response::FORMAT_RAW;
        $response->headers->add('content-type', 'image/jpg');
        $img_data = file_get_contents('uploads\profilePictures/CEO1.jpg');
        $response->data = $img_data;
        return $response;


        return $_FILES["file2"]["name"];
        move_uploaded_file($_FILES["file"]["tmp_name"], "uploads/profilePictures/" . $_FILES["file"]["name"]);
        return Yii::$app->request->post();
        return "Sucesso no upload";
    } */

    public function actionEditar(){
        $access_header = Yii::$app->request->headers->get("Authorization");
        $access_token = str_replace("Basic ", "", $access_header);
        $access_token = base64_decode($access_token);
        $access_token = str_replace(":", "", $access_token);
        $user = UserRest::findOne(["access_token" => $access_token]);

        $model = ProfileRest::find()->where(['user_id' =>$user->id])->one();

        $model->load(Yii::$app->request->post(), '');

        if(isset($_FILES["file"])){ //atualização imagem perfil
            if(move_uploaded_file($_FILES["file"]["tmp_name"], "uploads/profilePictures/" . $_FILES["file"]["name"])){
                $fotografiaModel = Fotografia::registrarFotografia("profilePictures/" . $_FILES["file"]["name"]);
                $model->idFotografia = $fotografiaModel;
            }
        }

        $model->save();
        return $model;
    }

    public function actionEditarDefinicoesPerfil(){
        $access_header = Yii::$app->request->headers->get("Authorization");
        $access_token = str_replace("Basic ", "", $access_header);
        $access_token = base64_decode($access_token);
        $access_token = str_replace(":", "", $access_token);
        $user = UserRest::findOne(["access_token" => $access_token]);

        if(Yii::$app->security->validatePassword(Yii::$app->request->post("password"), $user->password)) {

            if(Yii::$app->request->post("email") !== $user->email){
                $profile = Profile::findOne($user->id);
                $profile->email = Yii::$app->request->post("email");
                $profile->save();
                $user->email = Yii::$app->request->post("email");
                $user->save();
            }

        } else {
            throw new ForbiddenHttpException("Password errada.");
        }

        return ["username" => $user->username, "email" => $user->email];
    }
}