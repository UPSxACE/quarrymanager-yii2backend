<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "transportadora".
 *
 * @property int $id
 * @property string $nome
 *
 * @property PedidoLote[] $pedidoLotes
 */
class Transportadora extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'transportadora';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nome'], 'required'],
            [['nome'], 'string', 'max' => 150],
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
     * Gets query for [[PedidoLotes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPedidoLotes()
    {
        return $this->hasMany(PedidoLote::className(), ['idTransportadora' => 'id']);
    }
}
