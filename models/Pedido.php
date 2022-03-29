<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pedido".
 *
 * @property int $id
 * @property int $idUtilizador
 * @property int|null $idProduto
 * @property float|null $desconto
 * @property float|null $quantidade
 * @property string $nome
 * @property string|null $morada
 * @property string|null $telefone
 * @property string|null $email
 * @property string|null $mensagem
 * @property int|null $nif
 * @property string $dataHoraPedido
 *
 * @property EstadoPedido[] $estadoPedidos
 * @property Produto $idProduto0
 * @property Utilizador $idUtilizador0
 * @property PedidoLote[] $pedidoLotes
 */
class Pedido extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pedido';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idUtilizador', 'nome', 'dataHoraPedido'], 'required'],
            [['idUtilizador', 'idProduto', 'nif'], 'integer'],
            [['desconto', 'quantidade'], 'number'],
            [['dataHoraPedido'], 'safe'],
            [['nome', 'morada', 'mensagem'], 'string', 'max' => 150],
            [['telefone'], 'string', 'max' => 15],
            [['email'], 'string', 'max' => 70],
            [['idUtilizador'], 'exist', 'skipOnError' => true, 'targetClass' => Utilizador::className(), 'targetAttribute' => ['idUtilizador' => 'id']],
            [['idProduto'], 'exist', 'skipOnError' => true, 'targetClass' => Produto::className(), 'targetAttribute' => ['idProduto' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'idUtilizador' => 'Id Utilizador',
            'idProduto' => 'Id Produto',
            'desconto' => 'Desconto',
            'quantidade' => 'Quantidade',
            'nome' => 'Nome',
            'morada' => 'Morada',
            'telefone' => 'Telefone',
            'email' => 'Email',
            'mensagem' => 'Mensagem',
            'nif' => 'Nif',
            'dataHoraPedido' => 'Data Hora Pedido',
        ];
    }

    /**
     * Gets query for [[EstadoPedidos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEstadoPedidos()
    {
        return $this->hasMany(EstadoPedido::className(), ['idPedido' => 'id']);
    }

    /**
     * Gets query for [[IdProduto0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdProduto0()
    {
        return $this->hasOne(Produto::className(), ['id' => 'idProduto']);
    }

    /**
     * Gets query for [[IdUtilizador0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdUtilizador0()
    {
        return $this->hasOne(Utilizador::className(), ['id' => 'idUtilizador']);
    }

    /**
     * Gets query for [[PedidoLotes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPedidoLotes()
    {
        return $this->hasMany(PedidoLote::className(), ['idPedido' => 'id']);
    }
}