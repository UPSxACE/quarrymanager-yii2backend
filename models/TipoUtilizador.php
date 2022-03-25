<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tipoutilizador".
 *
 * @property int $id
 * @property string|null $nome
 *
 * @property Utilizador[] $utilizadors
 */
class TipoUtilizador extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tipoutilizador';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
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
     * Gets query for [[Utilizadors]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUtilizadors()
    {
        return $this->hasMany(Utilizador::className(), ['tipoUtilizador' => 'id']);
    }
}
