<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "estado".
 *
 * @property int $id
 * @property string $nome
 *
 * @property EstadoPedido[] $estadoPedidos
 */
class Estado extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'estado';
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
     * Gets query for [[EstadoPedidos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEstadoPedidos()
    {
        return $this->hasMany(EstadoPedido::className(), ['idEstado' => 'id']);
    }
}
