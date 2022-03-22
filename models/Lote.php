<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "lote".
 *
 * @property string $codigo_lote
 * @property int $idProduto
 * @property float $quantidade
 * @property int $idLocalExtracao
 * @property int|null $idLocalArmazem
 * @property string|null $dataHora
 *
 * @property FotografiaLote[] $fotografiaLotes
 * @property Localarmazem $idLocalArmazem0
 * @property Localextracao $idLocalExtracao0
 * @property Produto $idProduto0
 * @property PedidoLote[] $pedidoLotes
 */
class Lote extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'lote';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['codigo_lote', 'idProduto', 'quantidade', 'idLocalExtracao'], 'required'],
            [['idProduto', 'idLocalExtracao', 'idLocalArmazem'], 'integer'],
            [['quantidade'], 'number'],
            [['dataHora'], 'safe'],
            [['codigo_lote'], 'string', 'max' => 50],
            [['codigo_lote'], 'unique'],
            [['idLocalExtracao'], 'exist', 'skipOnError' => true, 'targetClass' => Localextracao::className(), 'targetAttribute' => ['idLocalExtracao' => 'id']],
            [['idLocalArmazem'], 'exist', 'skipOnError' => true, 'targetClass' => Localarmazem::className(), 'targetAttribute' => ['idLocalArmazem' => 'id']],
            [['idProduto'], 'exist', 'skipOnError' => true, 'targetClass' => Produto::className(), 'targetAttribute' => ['idProduto' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'codigo_lote' => 'Codigo Lote',
            'idProduto' => 'Id Produto',
            'quantidade' => 'Quantidade',
            'idLocalExtracao' => 'Id Local Extracao',
            'idLocalArmazem' => 'Id Local Armazem',
            'dataHora' => 'Data Hora',
        ];
    }

    /**
     * Gets query for [[FotografiaLotes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFotografiaLotes()
    {
        return $this->hasMany(FotografiaLote::className(), ['codigoLote' => 'codigo_lote']);
    }

    /**
     * Gets query for [[IdLocalArmazem0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdLocalArmazem0()
    {
        return $this->hasOne(Localarmazem::className(), ['id' => 'idLocalArmazem']);
    }

    /**
     * Gets query for [[IdLocalExtracao0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdLocalExtracao0()
    {
        return $this->hasOne(Localextracao::className(), ['id' => 'idLocalExtracao']);
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
     * Gets query for [[PedidoLotes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPedidoLotes()
    {
        return $this->hasMany(PedidoLote::className(), ['codigoLote' => 'codigo_lote']);
    }
}
