<?php

namespace app\modules\api\models;

use app\models\EstadoPedido;
use yii\data\ActiveDataProvider;


class EstadoPedidoRest extends EstadoPedido
{

    public function fields()
    {
        return ['dataEstado','idPedido','idPedido0', 'idEstado0'];
    }

    public function dadosListar($params)
    {
        $query = EstadoPedidoRest::find()->where(['last' => '1']);
        //  ->innerJoinWith('idCor0');
        //->joinWith(['idMaterial0']);


        $dataProvider = new ActiveDataProvider([
            'query'=>$query,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        $this->load($params, "");


        return $dataProvider;
    }

    public function getIdPedido0()
    {
        return $this->hasOne(PedidoRest::className(), ['id' => 'idPedido']);
    }

    public function getIdEstado0()
    {
        return $this->hasOne(EstadoRest::className(), ['id' => 'idEstado']);
    }

}