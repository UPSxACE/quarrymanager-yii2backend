<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Produto;

/**
 * ProdutoSearch represents the model behind the search form of `app\models\Produto`.
 */
class ProdutoSearch extends Produto
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'idMaterial', 'idCor'], 'integer'],
            [['Res_Compressao', 'Res_Flexao', 'Massa_Vol_Aparente', 'Absorcao_Agua', 'preco'], 'number'],
            [['tituloArtigo', 'descricaoProduto'], 'safe'],
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
        $query = Produto::find();

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
            'idMaterial' => $this->idMaterial,
            'idCor' => $this->idCor,
            'Res_Compressao' => $this->Res_Compressao,
            'Res_Flexao' => $this->Res_Flexao,
            'Massa_Vol_Aparente' => $this->Massa_Vol_Aparente,
            'Absorcao_Agua' => $this->Absorcao_Agua,
            'preco' => $this->preco,
        ]);

        $query->andFilterWhere(['like', 'tituloArtigo', $this->tituloArtigo])
            ->andFilterWhere(['like', 'descricaoProduto', $this->descricaoProduto]);

        return $dataProvider;
    }
}
