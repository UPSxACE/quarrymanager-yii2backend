<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "material".
 *
 * @property int $id
 * @property string $nome
 * @property string $prefixo
 *
 * @property Produto[] $produtos
 */
class Material extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'material';
    }

    public static function getAllAsArray(){

        $res = Material::find()->asArray()->all();
        $arrayMateriais = ArrayHelper::map($res, 'id', 'nome');
        return $arrayMateriais;
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nome'], 'required'],
            [['nome'], 'string', 'max' => 100],
            [['prefixo'], 'string', 'max' => 3],
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
            'prefixo' => 'Prefixo'
        ];
    }

    /**
     * Gets query for [[Produtos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProdutos()
    {
        return $this->hasMany(Produto::className(), ['idMaterial' => 'id']);
    }
}
