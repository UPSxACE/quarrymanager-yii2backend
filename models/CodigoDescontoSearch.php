<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\CodigoDesconto;

/**
 * CodigoDescontoSearch represents the model behind the search form of `app\models\CodigoDesconto`.
 */
class CodigoDescontoSearch extends CodigoDesconto
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['codigo', 'descricao', 'dataExpiracao'], 'safe'],
            [['descontoGeral', 'descontoProduto'], 'number'],
            [['idProduto'], 'integer'],
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
        $query = CodigoDesconto::find();

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
            'descontoGeral' => $this->descontoGeral,
            'idProduto' => $this->idProduto,
            'descontoProduto' => $this->descontoProduto,
            'dataExpiracao' => $this->dataExpiracao,
        ]);

        $query->andFilterWhere(['like', 'codigo', $this->codigo])
            ->andFilterWhere(['like', 'descricao', $this->descricao]);

        return $dataProvider;
    }
}
