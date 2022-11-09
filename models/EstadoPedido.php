<?php

namespace app\models;

use Yii;
use yii2tech\ar\softdelete\SoftDeleteBehavior;

/**
 * This is the model class for table "estado_pedido".
 *
 * @property int $id
 * @property int $idEstado
 * @property int $idPedido
 * @property string|null $dataEstado
 *
 * @property Estado $idEstado0
 * @property Pedido $idPedido0
 */
class EstadoPedido extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */

    public function behaviors()
    {
        return [
            'softDeleteBehavior' => [
                'class' => SoftDeleteBehavior::className(),
                'softDeleteAttributeValues' => [
                    'isDeleted' => true
                ],
                'replaceRegularDelete' => true // mutate native `delete()` method
            ],
        ];
    }

    public static function tableName()
    {
        return 'estado_pedido';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idEstado', 'idPedido'], 'required'],
            [['idEstado', 'idPedido'], 'integer'],
            [['dataEstado'], 'safe'],
            [['idEstado'], 'exist', 'skipOnError' => true, 'targetClass' => Estado::className(), 'targetAttribute' => ['idEstado' => 'id']],
            [['idPedido'], 'exist', 'skipOnError' => true, 'targetClass' => Pedido::className(), 'targetAttribute' => ['idPedido' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'idEstado' => 'Id Estado',
            'idPedido' => 'Id Pedido',
            'dataEstado' => 'Data Estado',
        ];
    }

    /**
     * Gets query for [[IdEstado0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdEstado0()
    {
        return $this->hasOne(Estado::className(), ['id' => 'idEstado']);
    }

    /**
     * Gets query for [[IdPedido0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdPedido0()
    {
        return $this->hasOne(Pedido::className(), ['id' => 'idPedido']);
    }

    public static function cancelarPedido($idPedido){
        $EstadoPedido = EstadoPedido::find()->where(['idPedido' => $idPedido])->andWhere(['last' => '1'])->one();
        $EstadoPedido->last = 0;
        if ($EstadoPedido->save()){
            $novoEstadoPedido = new EstadoPedido();
            $novoEstadoPedido->idEstado = 10;
            $novoEstadoPedido->idPedido = $idPedido;
            $novoEstadoPedido->dataEstado = date('Y-m-d H:i:s');
            $novoEstadoPedido->last = 1;
            if($novoEstadoPedido->save()){
                return true;
            }
        }

        return false;
    }
}
