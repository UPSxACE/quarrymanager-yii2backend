<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pedido_lote".
 *
 * @property int $id
 * @property int $idPedido
 * @property string $codigoLote
 * @property string|null $trackingID
 * @property float $quantidade
 * @property int|null $idTransportadora
 * @property string|null $matricula_Veiculo_recolha
 * @property string|null $dataHoraRecolha
 *
 * @property Lote $codigoLote0
 * @property Pedido $idPedido0
 * @property Transportadora $idTransportadora0
 */
class PedidoLote extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pedido_lote';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idPedido', 'codigoLote', 'quantidade'], 'required'],
            [['idPedido', 'idTransportadora'], 'integer'],
            [['quantidade'], 'number'],
            [['dataHoraRecolha'], 'safe'],
            [['codigoLote'], 'string', 'max' => 50],
            [['trackingID'], 'string', 'max' => 60],
            [['matricula_Veiculo_recolha'], 'string', 'max' => 30],
            [['idTransportadora'], 'exist', 'skipOnError' => true, 'targetClass' => Transportadora::className(), 'targetAttribute' => ['idTransportadora' => 'id']],
            [['codigoLote'], 'exist', 'skipOnError' => true, 'targetClass' => Lote::className(), 'targetAttribute' => ['codigoLote' => 'codigo_lote']],
            [['idPedido'], 'exist', 'skipOnError' => true, 'targetClass' => Pedido::className(), 'targetAttribute' => ['idPedido' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'idPedido' => 'Id Pedido',
            'codigoLote' => 'Codigo Lote',
            'trackingID' => 'Tracking ID',
            'quantidade' => 'Quantidade',
            'idTransportadora' => 'Id Transportadora',
            'matricula_Veiculo_recolha' => 'Matricula Veiculo Recolha',
            'dataHoraRecolha' => 'Data Hora Recolha',
        ];
    }

    /**
     * Gets query for [[CodigoLote0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCodigoLote0()
    {
        return $this->hasOne(Lote::className(), ['codigo_lote' => 'codigoLote']);
    }

    /**
     * Gets query for [[IdPedido0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdPedido0()
    {
        return $this->hasOne(Pedido::className(), ['id' => 'idPedido']);
    }

    /**
     * Gets query for [[IdTransportadora0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdTransportadora0()
    {
        return $this->hasOne(Transportadora::className(), ['id' => 'idTransportadora']);
    }
}
