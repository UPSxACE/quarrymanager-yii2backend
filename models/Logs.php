<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "logs".
 *
 * @property int $id
 * @property int|null $idUtilizador
 * @property int|null $idTipoAcao
 * @property string|null $descricao
 * @property string|null $dataHora
 *
 * @property Tipoacao $idTipoAcao0
 * @property Utilizador $idUtilizador0
 */
class Logs extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'logs';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idUtilizador', 'idTipoAcao'], 'integer'],
            [['dataHora'], 'safe'],
            [['descricao'], 'string', 'max' => 255],
            [['idTipoAcao'], 'exist', 'skipOnError' => true, 'targetClass' => Tipoacao::className(), 'targetAttribute' => ['idTipoAcao' => 'id']],
            [['idUtilizador'], 'exist', 'skipOnError' => true, 'targetClass' => Utilizador::className(), 'targetAttribute' => ['idUtilizador' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'idUtilizador' => 'Id Utilizador',
            'idTipoAcao' => 'Id Tipo Acao',
            'descricao' => 'Descricao',
            'dataHora' => 'Data Hora',
        ];
    }

    /**
     * Gets query for [[IdTipoAcao0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdTipoAcao0()
    {
        return $this->hasOne(Tipoacao::className(), ['id' => 'idTipoAcao']);
    }

    /**
     * Gets query for [[IdUtilizador0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdUtilizador0()
    {
        return $this->hasOne(Utilizador::className(), ['id' => 'idUtilizador']);
    }
}
