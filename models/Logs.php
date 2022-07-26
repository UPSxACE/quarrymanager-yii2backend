<?php

namespace app\models;

use Yii;
use yii2tech\ar\softdelete\SoftDeleteBehavior;

/**
 * This is the model class for table "logs".
 *
 * @property int $id
 * @property int|null $idUser
 * @property int|null $idTipoAcao
 * @property string|null $descricao
 * @property string|null $dataHora
 *
 * @property Tipoacao $idTipoAcao0
 * @property User $idUser0
 */

class Logs extends \yii\db\ActiveRecord
{
    public function behaviors()
    {
        return [
            'softDeleteBehavior' => [
                'class' => SoftDeleteBehavior::className(),
                'softDeleteAttributeValues' => [
                    'isDeleted' => true
                ],
                'replaceRegularDelete' => true // mutate native delete() method
            ],
        ];

    }
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
            [['idUser', 'idTipoAcao'], 'integer'],
            [['dataHora'], 'safe'],
            [['descricao'], 'string', 'max' => 255],
            [['idTipoAcao'], 'exist', 'skipOnError' => true, 'targetClass' => Tipoacao::className(), 'targetAttribute' => ['idTipoAcao' => 'id']],
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
     * Gets query for [[IdUser0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdUser0()
    {
        return $this->hasOne(User::className(), ['id' => 'idUser']);
    }

    static public function registrarLogSystem($idTipoAcao, $descricao){
        $model = new Logs();
        $model->idTipoAcao = $idTipoAcao;
        $model->descricao = $descricao;
        $model->dataHora = date('y-m-d H:i:s', time());

        if($model->validate()){
            $model->save();
        }
    }

    static public function registrarLogUser($idUser, $idTipoAcao, $descricao){

        $model = new Logs();
        $model->idUser = $idUser;
        $model->idTipoAcao = $idTipoAcao;
        $model->descricao = $descricao;
        $model->dataHora = date('y-m-d H:i:s', time());

        if($model->validate()){
            $model->save();
        }

    }

}
