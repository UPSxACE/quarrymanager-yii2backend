<?php

namespace app\models;

use Yii;
use yii2tech\ar\softdelete\SoftDeleteBehavior;

/**
 * This is the model class for table "fotografia_produto".
 *
 * @property int $id
 * @property int $idProduto
 * @property int $idFotografia
 *
 * @property Fotografia $idFotografia0
 * @property Produto $idProduto0
 */
class FotografiaProduto extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */

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

    public static function tableName()
    {
        return 'fotografia_produto';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idProduto', 'idFotografia'], 'required'],
            [['id', 'idProduto', 'idFotografia'], 'integer'],
            [['id'], 'unique'],
            [['idFotografia'], 'exist', 'skipOnError' => true, 'targetClass' => Fotografia::className(), 'targetAttribute' => ['idFotografia' => 'id']],
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
            'idProduto' => 'Id Produto',
            'idFotografia' => 'Id Fotografia',
        ];
    }

    /**
     * Gets query for [[IdFotografia0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdFotografia0()
    {
        return $this->hasOne(Fotografia::className(), ['id' => 'idFotografia']);
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

    static public function getInfoProduto($idProduto){
        $find_fotografia_produto = FotografiaProduto::find()->where(['idProduto' => $idProduto])->one();
        $idFotografia = $find_fotografia_produto->idFotografia;
        $find_fotografia = Fotografia::find()->where(['id' => $idFotografia])->one();
        $link = $find_fotografia->link;
        return($link);
    }

    public static function registrarFotografiaProduto($idProduto, $idFotografia){
        $model = new FotografiaProduto();
        $model->idProduto = $idProduto;
        $model->idFotografia = $idFotografia;
        if($model->save()){
            return true;
        }
        return false;
    }
}
