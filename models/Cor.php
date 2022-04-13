<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "cor".
 *
 * @property int $id
 * @property string $nome
 *
 * @property Produto[] $produtos
 */
class Cor extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cor';
    }

    public static function getAllAsArray(){
        $res = Cor::find()->asArray()->all();
        $arrayCores = ArrayHelper::map($res, 'id', 'nome');
        return $arrayCores;
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nome'], 'required'],
            [['nome'], 'string', 'max' => 100],
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
     * Gets query for [[Produtos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProdutos()
    {
        return $this->hasMany(Produto::className(), ['idCor' => 'id']);
    }
}
