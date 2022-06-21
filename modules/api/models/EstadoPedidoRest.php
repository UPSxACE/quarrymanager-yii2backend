<?php

namespace app\modules\api\models;

use app\models\EstadoPedido;
use yii\data\ActiveDataProvider;


class EstadoPedidoRest extends EstadoPedido
{

    public static $estado_inicial = 1; // estado inicial de uma encomenda


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
                'pageSize' => 7,
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

    public static function registrarNovoPedido($idPedido){
        $model = new EstadoPedido();
        $model->idPedido = $idPedido;
        $model->idEstado = EstadoPedidoRest::$estado_inicial;
        $model->dataEstado = date('Y-m-d H:i:s');
        $model->last = 1;
        $model->save();
        return $model;
    }

    public function ultimosSeisMeses(){
        $hoje = date("Y/m/d");
        $ultimo_1 = date('Y-m-t', strtotime($hoje));
        $ultimo_2 = date('Y-m-d', strtotime("last day of -1 month"));
        $ultimo_3 = date('Y-m-d', strtotime("last day of -2 month"));
        $ultimo_4 = date('Y-m-d', strtotime("last day of -3 month"));
        $ultimo_5 = date('Y-m-d', strtotime("last day of -4 month"));
        $ultimo_6 = date('Y-m-d', strtotime("last day of -5 month"));
        $meses = [$ultimo_1, $ultimo_2, $ultimo_3, $ultimo_4,$ultimo_5, $ultimo_6];

        foreach ($meses as &$mes){
            $mes = [date('m', strtotime($mes)), date('Y', strtotime($mes))];
        }

        $mes1 = EstadoPedidoRest::find()
            ->andWhere(['last' => '1'])->andWhere(['>=', 'idEstado', 8])
            ->andWhere(['last' => '1'])->andWhere(['<', 'idEstado', 10])
            ->andWhere(["month(estado_pedido.dataEstado)" => $meses[0][0]])
            ->andWhere(["year(estado_pedido.dataEstado)" => $meses[0][1]])
            ->count();
        $mes2 = EstadoPedidoRest::find()
            ->andWhere(['last' => '1'])->andWhere(['>=', 'idEstado', 8])
            ->andWhere(['last' => '1'])->andWhere(['<', 'idEstado', 10])
            ->andWhere(["month(estado_pedido.dataEstado)" => $meses[1][0]])
            ->andWhere(["year(estado_pedido.dataEstado)" => $meses[1][1]])
            ->count();
        $mes3 = EstadoPedidoRest::find()
            ->andWhere(['last' => '1'])->andWhere(['>=', 'idEstado', 8])
            ->andWhere(['last' => '1'])->andWhere(['<', 'idEstado', 10])
            ->andWhere(["month(estado_pedido.dataEstado)" => $meses[2][0]])
            ->andWhere(["year(estado_pedido.dataEstado)" => $meses[2][1]])
            ->count();
        $mes4 = EstadoPedidoRest::find()
            ->andWhere(['last' => '1'])->andWhere(['>=', 'idEstado', 8])
            ->andWhere(['last' => '1'])->andWhere(['<', 'idEstado', 10])
            ->andWhere(["month(estado_pedido.dataEstado)" => $meses[3][0]])
            ->andWhere(["year(estado_pedido.dataEstado)" => $meses[3][1]])
            ->count();
        $mes5 = EstadoPedidoRest::find()
            ->andWhere(['last' => '1'])->andWhere(['>=', 'idEstado', 8])
            ->andWhere(['last' => '1'])->andWhere(['<', 'idEstado', 10])
            ->andWhere(["month(estado_pedido.dataEstado)" => $meses[4][0]])
            ->andWhere(["year(estado_pedido.dataEstado)" => $meses[4][1]])
            ->count();
        $mes6 = EstadoPedidoRest::find()
            ->andWhere(['last' => '1'])->andWhere(['>=', 'idEstado', 8])
            ->andWhere(['last' => '1'])->andWhere(['<', 'idEstado', 10])
            ->andWhere(["month(estado_pedido.dataEstado)" => $meses[5][0]])
            ->andWhere(["year(estado_pedido.dataEstado)" => $meses[5][1]])
            ->count();



        return [0 => $mes1, -1 => $mes2, -2 => $mes3, -3 => $mes4, -4 => $mes5, -5 => $mes6];
    }
}