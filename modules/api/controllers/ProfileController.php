<?php

namespace app\modules\api\controllers;


use app\models\UploadForm;
use app\modules\api\models\ProfileRest;
use app\modules\api\models\UserRest;
use Yii;
use yii\rest\ActiveController;

class ProfileController extends BaseController
{
    public $modelClass = ProfileRest::class;

    public function behaviors(){
        $behaviors = parent::behaviors();
        $behaviors['access']['rules'][] = [
            'actions' =>  ['index', 'view', 'create', 'update', 'delete', 'options', 'get-profile', 'test-image-upload', 'editar' ],
            'allow' => true,
            'roles' => ['operario'] // se tirar o role, qualquer utilizar AUTENTICADO pode usar o serviço.
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
    }

    public function actionEditar(){
        $access_header = Yii::$app->request->headers->get("Authorization");
        $access_token = str_replace("Basic ", "", $access_header);
        $access_token = base64_decode($access_token);
        $access_token = str_replace(":", "", $access_token);
        $user = UserRest::findOne(["access_token" => $access_token]);

        $model = ProfileRest::find()->where(['user_id' =>Yii::$app->request->post($user->id)])->one();
        $model->load(yii::$app->request->post(), '');
        $model->save();
        return $model;
    }
}