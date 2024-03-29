<?php

namespace app\models;

use app\modules\api\models\FirebaseRest;
use Yii;
use yii\httpclient\Client;
use yii2tech\ar\softdelete\SoftDeleteBehavior;

/**
 * This is the model class for table "pedido".
 *
 * @property int $id
 * @property int $idUser
 * @property int|null $idProduto
 * @property float|null $desconto
 * @property float|null $quantidade
 *  * @property float|null $precoFinal
 * @property string|null $mensagem
 * @property string $dataHoraPedido
 *
 * @property EstadoPedido[] $estadoPedidos
 * @property Produto $idProduto0
 * @property User $idUser0
 * @property PedidoLote[] $pedidoLotes
 */
class Pedido extends \yii\db\ActiveRecord
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
        return 'pedido';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idUser', 'dataHoraPedido'], 'required'],
            [['idUser', 'idProduto'], 'integer'],
            [['codigo_desconto'], 'string', 'max' => 150],
            [['desconto', 'quantidade', 'precoFinal'], 'number'],
            [['dataHoraPedido'], 'safe'],
            [['mensagem'], 'string', 'max' => 150],
            [['idProduto'], 'exist', 'skipOnError' => true, 'targetClass' => Produto::className(), 'targetAttribute' => ['idProduto' => 'id']],
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
            'idProduto' => 'Id Produto',
            'desconto' => 'Desconto',
            'codigo_desconto' => 'Código de Desconto',
            'quantidade' => 'Quantidade(m²)',
            'mensagem' => 'Mensagem',
            'dataHoraPedido' => 'Data Hora Pedido',
            'precoFinal' => 'Preço Final'
        ];
    }

    /**
     * Gets query for [[EstadoPedidos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEstadoPedidos()
    {
        return $this->hasMany(EstadoPedido::className(), ['idPedido' => 'id']);
    }

    public function ultimoEstadoId(){
        //$estado = new EstadoPedido();
        //$estado->idEstado0->afterFind()
        //idPedido0->afterFind()->where(['idPedido' => $this->id])
        //return EstadoPedido::find()->where(['idPedido' => $this->id])->andWhere(['last'=>'1']);
        $EstadoPedido = EstadoPedido::find()->where(['idPedido' => $this->id])->andWhere(['last' => '1'])->one();
        $estado = Estado::find()->where(['id' => $EstadoPedido->idEstado])->one();
        return $estado->id ;
    }

    public function nextState($id){
        $EstadoPedidoAtual = EstadoPedido::find()->where(['idPedido' => $this->id])->andWhere(['last' => '1'])->one();
        $estadoAtual = $EstadoPedidoAtual->idEstado;
        $EstadoPedidoAtual->last = '0';
        if($EstadoPedidoAtual->save()){
            $modelEstadoPedido = new EstadoPedido();

            //$modelEncomenda = Pedido::find()->where(['id'=>$id])->one();
            //$estadoAtual = $modelEncomenda->ultimoEstadoId();
            ;

            $modelEstadoPedido->idEstado = $estadoAtual+1;
            $modelEstadoPedido->idPedido = $id;
            $modelEstadoPedido->dataEstado = date('Y-m-d H:i:s');//;
            $modelEstadoPedido->last = 1;

            if($modelEstadoPedido->save()){
                $client = new Client();
                $client->createRequest()
                    ->setMethod("PUT")
                    ->setFormat(Client::FORMAT_JSON)
                    ->setUrl("https://ds3-gestorapedreira-default-rtdb.europe-west1.firebasedatabase.app/pedidos-listagem/" . $modelEstadoPedido->idPedido . "/estado.json")
                    ->setData($modelEstadoPedido->idPedido0->ultimoEstadoNome())
                    ->send();

                FirebaseRest::notificarAtualizacaoPedido($modelEstadoPedido->idPedido, $modelEstadoPedido->idPedido0->ultimoEstadoNome(), Produto::findOne(["id" => $modelEstadoPedido->idPedido0->idProduto])->tituloArtigo);
                return true;
            }

            return false;
        }
        return false;




    }

    public function ultimoEstadoNome(){
        //$estado = new EstadoPedido();
        //$estado->idEstado0->afterFind()
        //idPedido0->afterFind()->where(['idPedido' => $this->id])
        //return EstadoPedido::find()->where(['idPedido' => $this->id])->andWhere(['last'=>'1']);
        $EstadoPedido = EstadoPedido::find()->where(['idPedido' => $this->id])->andWhere(['last' => '1'])->one();
        $estado = Estado::find()->where(['id' => $EstadoPedido->idEstado])->one();
        return $estado->nome;
    }

    /**
     * Gets query for [[IdProduto0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdProduto0()
    {
        return $this->hasOne(Produto::className(), ['id' => 'idProduto']);
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

    /**
     * Gets query for [[PedidoLotes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPedidoLotes()
    {
        return $this->hasMany(PedidoLote::className(), ['idPedido' => 'id']);
    }
}
