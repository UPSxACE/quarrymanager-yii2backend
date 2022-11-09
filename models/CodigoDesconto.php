<?php

namespace app\models;

use Yii;
use yii2tech\ar\softdelete\SoftDeleteBehavior;

/**
 * This is the model class for table "codigodesconto".
 *
 * @property string $codigo
 * @property string|null $descricao
 * @property float|null $descontoGeral
 * @property int|null $idProduto
 * @property float|null $descontoProduto
 * @property string|null $dataExpiracao
 *
 * @property Produto $idProduto0
 */
class CodigoDesconto extends \yii\db\ActiveRecord
{
    public function behaviors()
    {
        return [
            'softDeleteBehavior' => [
                'class' => SoftDeleteBehavior::className(),
                'softDeleteAttributeValues' => [
                    'isDeleted' => true
                ],
                'replaceRegularDelete' => true // mutate native `delete()` method
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */

    public static function tableName()
    {
        return 'codigodesconto';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['codigo'], 'required'],
            [['descontoGeral', 'descontoProduto'], 'number'],
            [['idProduto'], 'integer'],
            [['dataExpiracao'], 'safe'],
            [['codigo'], 'string', 'max' => 40],
            [['descricao'], 'string', 'max' => 255],
            [['codigo'], 'unique'],
            [['idProduto'], 'exist', 'skipOnError' => true, 'targetClass' => Produto::className(), 'targetAttribute' => ['idProduto' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'codigo' => 'Codigo',
            'descricao' => 'Descricao',
            'descontoGeral' => 'Desconto Geral',
            'idProduto' => 'Id Produto',
            'descontoProduto' => 'Desconto Produto',
            'dataExpiracao' => 'Data Expiracao',
        ];
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
}
