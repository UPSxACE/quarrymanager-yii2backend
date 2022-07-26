<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii2tech\ar\softdelete\SoftDeleteBehavior;

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
    public function behaviors()
    {
        return [
            'softDeleteBehavior' => [
                'class' => SoftDeleteBehavior::className(),
                'softDeleteAttributeValues' => [
                    'isDeleted' => true
                ],
                'replaceRegularDelete' => true // mutate native delete() method
            ],
        ];

    }
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
            'codigo_lote' => 'Código do Lote',
            'idProduto' => 'Produto',
            'quantidade' => 'Quantidade',
            'idLocalExtracao' => 'Local Extracão',
            'idLocalArmazem' => 'Local Armazem',
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

    public static function countProducts($idProduto){
        $count = Lote::find()->where(['idProduto' => $idProduto])->count();
        return $count;
    }

    public static function gerarCodigoLote($idProduto){
        $produto = Produto::find()->where(['id' => $idProduto])->one();
        $material_prefixo = $produto->idMaterial0->prefixo;
        $cor_prefixo = $produto->idCor0->prefixo;
        $idNumerico =  Lote::countProducts($idProduto) + 1;

        $codigo_lote = $material_prefixo . '_' . $cor_prefixo . '_' . str_pad($idNumerico, 5, '0', STR_PAD_LEFT);
        return $codigo_lote;
    }

    public static function getAllOfSpecificProductAsArray($idProduto){

        $res = Lote::find()->where(['idProduto' => $idProduto])->asArray()->all();
        $arrayLotes = ArrayHelper::map($res, 'codigo_lote', 'codigo_lote');

        //loop que vai iterar por todos os valores do array, e converter o id em uma string no formato: nome do material + nome da cor
        foreach ($arrayLotes as $chave => $valor){
            $lote = Lote::find()->where(['codigo_lote' => $chave])->one();

            $quantidade = $lote->codigo_lote . ' (' . strval($lote->quantidade) . 'm² disponível)';

            $arrayLotes[$chave] = $quantidade;
        }

        return $arrayLotes;
    }

    public static function reservarQuantidade($codigoLote, $quantidade){
        $lote = Lote::find()->where(['codigo_lote' => $codigoLote])->one();
        $lote->quantidade = $lote->quantidade - $quantidade;
        if($lote->save()){
            return true;
        }
        return false;
    }
}
