<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "localextracao".
 *
 * @property int $id
 * @property string $nome
 * @property float|null $coordenadasGPS_X
 * @property float|null $coordenadasGPS_Y
 *
 * @property Lote[] $lotes
 */
class LocalExtracao extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'localextracao';
    }

    public static function getAllAsArray(){
        $res = LocalExtracao::find()->asArray()->all();
        $localextracao = ArrayHelper::map($res, 'id', 'nome');
        return $localextracao;
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nome'], 'required'],
            [['coordenadasGPS_X', 'coordenadasGPS_Y'], 'number'],
            [['nome'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nome' => 'Nome',
            'coordenadasGPS_X' => 'Coordenadas Gps X',
            'coordenadasGPS_Y' => 'Coordenadas Gps Y',
        ];
    }

    /**
     * Gets query for [[Lotes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLotes()
    {
        return $this->hasMany(Lote::className(), ['idLocalExtracao' => 'id']);
    }


}
