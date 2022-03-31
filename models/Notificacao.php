<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "notificacao".
 *
 * @property int $id
 * @property int $idUser
 * @property string $mensagem
 * @property int $notificao_lida
 * @property string|null $origem
 *
 * @property User $idUser0
 */
class Notificacao extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'notificacao';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idUser', 'mensagem'], 'required'],
            [['idUser', 'notificao_lida'], 'integer'],
            [['mensagem'], 'string', 'max' => 255],
            [['origem'], 'string', 'max' => 100],
            [['idUser'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['idUser' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'idUser' => 'Id User',
            'mensagem' => 'Mensagem',
            'notificao_lida' => 'Notificao Lida',
            'origem' => 'Origem',
        ];
    }

    /**
     * Gets query for [[IdUser0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdUser0()
    {
        return $this->hasOne(User::className(), ['id' => 'idUser']);
    }
}
