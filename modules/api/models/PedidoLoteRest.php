<?php

namespace app\modules\api\models;

use app\models\PedidoLote;
use yii\data\ActiveDataProvider;


class PedidoLoteRest extends PedidoLote
{
    public function extraFields()
    {
        return ['idTransportadora0'];
    }

    public static function recolhasAgendadadas($id){
        $query = PedidoLoteRest::find()->where(['idPedido' => $id])->orderBy('dataHoraRecolha ASC'); //não recolhidos sempre vão aparecer primeiro
        $provider = new ActiveDataProvider([ // cria objeto data provider
            'query' => $query,
            'pagination' => [
                'pageSize' => 7,
            ],
        ]);

        return $provider;
    }
}