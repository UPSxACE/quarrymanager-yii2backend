<?php

namespace app\modules\api\controllers;
use app\modules\api\models\FirebaseRest;
use app\modules\api\models\PedidoRest;
use Yii;
use yii\rest\Controller;


class NotificationsController extends BaseController
{
    public $modelClass = PedidoRest::class;
    public function behaviors(){
        $behaviors = parent::behaviors();
        $behaviors['access']['rules'][] = [
            'actions' =>  ['index', 'notificar-gestores'],
            'allow' => true,
        ];

        return $behaviors;
    }

    public function actionNotificarGestores(){
        $pessoas_a_notificar = Yii::$app->request->post("pessoas_a_notificar");
        $pedido_titulo = Yii::$app->request->post("titulo");
        $mensagem = Yii::$app->request->post("mensagem");
        foreach($pessoas_a_notificar as $pessoa_id){
            FirebaseRest::notificarMensagem($pessoa_id,$pedido_titulo, $mensagem);
        }
        return "Feito";
    }
}