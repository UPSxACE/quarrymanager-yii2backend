<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "fotografia_lote".
 *
 * @property int $id
 * @property string $codigoLote
 * @property int $idFotografia
 *
 * @property Lote $codigoLote0
 * @property Fotografia $idFotografia0
 */
class FotografiaLote extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'fotografia_lote';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['codigoLote', 'idFotografia'], 'required'],
            [['id', 'idFotografia'], 'integer'],
            [['codigoLote'], 'string', 'max' => 50],
            [['id'], 'unique'],
            [['idFotografia'], 'exist', 'skipOnError' => true, 'targetClass' => Fotografia::className(), 'targetAttribute' => ['idFotografia' => 'id']],
            [['codigoLote'], 'exist', 'skipOnError' => true, 'targetClass' => Lote::className(), 'targetAttribute' => ['codigoLote' => 'codigo_lote']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'codigoLote' => 'Codigo Lote',
            'idFotografia' => 'Id Fotografia',
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
     * Gets query for [[IdFotografia0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdFotografia0()
    {
        return $this->hasOne(Fotografia::className(), ['id' => 'idFotografia']);
    }

    public static function registrarFotografiaLote($codigoLote, $idFotografia){
        $model = new FotografiaLote();
        $model->codigoLote = $codigoLote;
        $model->idFotografia = $idFotografia;
        if($model->save()){
            return true;
        }
        return false;
    }
}
