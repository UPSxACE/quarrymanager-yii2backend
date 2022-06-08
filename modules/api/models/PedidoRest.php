<?php

namespace app\modules\api\models;

use app\models\Cor;
use app\models\Material;
use app\models\Pedido;
use app\models\Produto;
use yii\data\ActiveDataProvider;

class PedidoRest extends Pedido
{
    public function fields()
    {

        return ['idUser0','idProduto0'];
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


}