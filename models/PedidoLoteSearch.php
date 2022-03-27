<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PedidoLote;

/**
 * PedidoLoteSearch represents the model behind the search form of `app\models\PedidoLote`.
 */
class PedidoLoteSearch extends PedidoLote
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'idPedido', 'idTransportadora'], 'integer'],
            [['codigoLote', 'trackingID', 'matricula_Veiculo_recolha', 'dataHoraRecolha'], 'safe'],
            [['quantidade'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = PedidoLote::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'idPedido' => $this->idPedido,
            'quantidade' => $this->quantidade,
            'idTransportadora' => $this->idTransportadora,
            'dataHoraRecolha' => $this->dataHoraRecolha,
        ]);

        $query->andFilterWhere(['like', 'codigoLote', $this->codigoLote])
            ->andFilterWhere(['like', 'trackingID', $this->trackingID])
            ->andFilterWhere(['like', 'matricula_Veiculo_recolha', $this->matricula_Veiculo_recolha]);

        return $dataProvider;
    }
}
