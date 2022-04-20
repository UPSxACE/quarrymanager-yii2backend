<?php

namespace app\models;

use Yii;
use yii\db\Query;

/**
 * This is the model class for table "produto".
 *
 * @property int $id
 * @property int $idMaterial
 * @property int $idFotografia
 * @property int|null $idCor
 * @property float|null $Res_Compressao
 * @property float|null $Res_Flexao
 * @property float|null $Massa_Vol_Aparente
 * @property float|null $Absorcao_Agua
 * @property string|null $tituloArtigo
 * @property string|null $descricaoProduto
 * @property float|null $preco
 *
 * @property Codigodesconto[] $codigodescontos
 * @property FotografiaProduto[] $fotografiaProdutos
 * @property Cor $idCor0
 * @property Material $idMaterial0
 * @property Lote[] $lotes
 * @property Pedido[] $pedidos
 * @property Fotografia $idFotografia0
 *
 * @property NumeroDePedidos $numeroPedidos
 */
class Produto extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */

    public $imageFile;

    const SCENARIO_PRODUTO = 'produto';
    const SCENARIO_LOJA = 'loja';

    public function scenarios(){

        $scenarios = parent::scenarios();
        $scenarios[self::SCENARIO_PRODUTO] = ['idMaterial', 'idCor', 'Res Compressao', 'Res Flexao', 'Massa Vol Aparente', 'Absorcao Agua'];
        $scenarios[self::SCENARIO_LOJA] = ['id', 'tituloArtigo', 'preco', 'descricaoProduto', 'imageFile'];
        return $scenarios;

    }

    public static function tableName()
    {
        return 'produto';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idMaterial'], 'required'],
            [['idMaterial', 'idCor'], 'integer'],
            [['Res_Compressao', 'Res_Flexao', 'Massa_Vol_Aparente', 'Absorcao_Agua', 'preco'], 'number'],
            [['tituloArtigo'], 'string', 'max' => 255],
            [['descricaoProduto'], 'string', 'max' => 2550],
            [['idCor'], 'exist', 'skipOnError' => true, 'targetClass' => Cor::className(), 'targetAttribute' => ['idCor' => 'id']],
            [['idMaterial'], 'exist', 'skipOnError' => true, 'targetClass' => Material::className(), 'targetAttribute' => ['idMaterial' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'idMaterial' => 'Material',
            'idCor' => 'Cor',
            'Res_Compressao' => 'Res Compressao',
            'Res_Flexao' => 'Res Flexao',
            'Massa_Vol_Aparente' => 'Massa Vol Aparente',
            'Absorcao_Agua' => 'Absorcao Agua',
            'tituloArtigo' => 'Titulo Artigo',
            'descricaoProduto' => 'Descricao Produto',
            'preco' => 'Preco',
        ];
    }

    /**
     * Gets query for [[Codigodescontos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCodigodescontos()
    {
        return $this->hasMany(Codigodesconto::className(), ['idProduto' => 'id']);
    }

    /**
     * Gets query for [[FotografiaProdutos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFotografiaProdutos()
    {
        return $this->hasMany(FotografiaProduto::className(), ['idProduto' => 'id']);
    }

    /**
     * Gets query for [[IdCor0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdCor0()
    {
        return $this->hasOne(Cor::className(), ['id' => 'idCor']);
    }

    /**
     * Gets query for [[IdMaterial0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdMaterial0()
    {
        return $this->hasOne(Material::className(), ['id' => 'idMaterial']);
    }

    public function getIdFotografia0()
    {
        return $this->hasOne(Fotografia::className(), ['id' => 'idFotografia']);
    }

    /**
     * Gets query for [[Lotes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLotes()
    {
        return $this->hasMany(Lote::className(), ['idProduto' => 'id']);
    }

    /**
     * Gets query for [[Pedidos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPedidos()
    {
        return $this->hasMany(Pedido::className(), ['idProduto' => 'id']);
    }

    public function numeroPedidos($idProduto){
        return Pedido::find()->where(['idProduto' => $idProduto])->count();
    }

    public function quantidadeVendida($idProduto){
        $sum = Pedido::find()->where(['idProduto' => $idProduto])->innerJoinWith('estadoPedidos', 'estadoPedidos.idPedido = id')->andWhere(['last' => '1'])->andWhere(['>=', 'idEstado', 2])->sum('pedido.quantidade');
        if ($sum>0){return $sum;} else return 0;
    }



    static public function getAllProducts(){
        $produtos = new Produto();
        $listaProdutos = $produtos->find()->all();
        return $listaProdutos;
    }

    public function uploadProductPicture()
    {
        if ($this->validate()) {
            $this->imageFile->saveAs('uploads/productPictures/' . $this->imageFile->baseName . '.' . $this->imageFile->extension);
            return true;
        } else {
            return false;
        }
    }
}
