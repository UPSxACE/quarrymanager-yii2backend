<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "localarmazem".
 *
 * @property int $id
 * @property string $nome
 *
 * @property Lote[] $lotes
 */
class LocalArmazem extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'localarmazem';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nome'], 'required'],
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
        ];
    }

    /**
     * Gets query for [[Lotes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLotes()
    {
        return $this->hasMany(Lote::className(), ['idLocalArmazem' => 'id']);
    }

    public static function getAllAsArray(){
        $res = LocalArmazem::find()->asArray()->all();
        $arrayLocaisArmazens = ArrayHelper::map($res, 'id', 'nome');
        return $arrayLocaisArmazens;
    }
}
