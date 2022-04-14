<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pedido".
 *
 * @property int $id
 * @property int $idUser
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
 * @property User $idUser0
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
            [['idUser', 'nome', 'dataHoraPedido'], 'required'],
            [['idUser', 'idProduto', 'nif'], 'integer'],
            [['desconto', 'quantidade'], 'number'],
            [['dataHoraPedido'], 'safe'],
            [['nome', 'morada', 'mensagem'], 'string', 'max' => 150],
            [['telefone'], 'string', 'max' => 15],
            [['email'], 'string', 'max' => 70],
            [['idProduto'], 'exist', 'skipOnError' => true, 'targetClass' => Produto::className(), 'targetAttribute' => ['idProduto' => 'id']],
            [['idUser'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['idUser' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'idUser' => 'Id User',
            'idProduto' => 'Id Produto',
            'desconto' => 'Desconto',
            'codigo_desconto' => 'Código de Desconto',
            'quantidade' => 'Quantidade(m²)',
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
     * Gets query for [[IdUser0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdUser0()
    {
        return $this->hasOne(User::className(), ['id' => 'idUser']);
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
