<?php

namespace app\modules\api\models;

use app\models\Cor;
use app\models\Estado;
use app\models\Lote;
use app\models\Material;
use app\models\Pedido;
use app\models\Produto;
use app\models\Transportadora;
use Yii;
use yii\data\ActiveDataProvider;

class PedidoRest extends Pedido
{
    public function fields()
    {

        return ['id', 'dataHoraPedido', 'idUser0','idProduto0', 'ultima_atualizacao' => function ($model) { $EstadoPedido = EstadoPedidoRest::find()->where(['idPedido' => $this->id])->andWhere(['last' => '1'])->one(); return $EstadoPedido->dataEstado;}, 'ultimo_estado' => function ($model) {$ultimo_estado = $model->ultimoEstadoId(); $estado = Estado::findOne($ultimo_estado); return $estado->nome;}];
    }

    public function extraFields()
    {
        return ['id_estado' => function ($model) { return $model->ultimoEstadoId();}];
    }

    public function getIdProduto0()
    {
        return $this->hasOne(ProdutoRest::className(), ['id' => 'idProduto']);
    }

    /**
     * Gets query for [[IdUser0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdUser0()
    {
        return $this->hasOne(UserRest::className(), ['id' => 'idUser']);
    }

    public static function agendarRecolhaOptions($idProduto){

        $lotes = LoteRest::find()->where(["idProduto" => $idProduto])->all();
        $lotesNomes = [];
        foreach($lotes as $lote){
            $lotesNomes[$lote->codigo_lote] = $lote->codigo_lote . " (" . $lote->quantidade . "m² disponível)";
        }
        $transporadoras = Transportadora::find()->all();
        $transporadorasNomes = [];
        foreach($transporadoras as $transporadora){
            $transporadorasNomes[$transporadora->id] = $transporadora->nome;
        }

        return ["lotes" => $lotesNomes, "transportadoras" => $transporadorasNomes];

    }


}