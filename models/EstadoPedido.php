<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "estado_pedido".
 *
 * @property int $id
 * @property int $idEstado
 * @property int $idPedido
 * @property string|null $dataEstado
 *
 * @property Estado $idEstado0
 * @property Pedido $idPedido0
 */
class EstadoPedido extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'estado_pedido';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idEstado', 'idPedido'], 'required'],
            [['idEstado', 'idPedido'], 'integer'],
            [['dataEstado'], 'safe'],
            [['idEstado'], 'exist', 'skipOnError' => true, 'targetClass' => Estado::className(), 'targetAttribute' => ['idEstado' => 'id']],
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
            'idEstado' => 'Id Estado',
            'idPedido' => 'Id Pedido',
            'dataEstado' => 'Data Estado',
        ];
    }

    /**
     * Gets query for [[IdEstado0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdEstado0()
    {
        return $this->hasOne(Estado::className(), ['id' => 'idEstado']);
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
}
