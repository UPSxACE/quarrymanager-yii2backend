<?php

namespace app\modules\api\models;

use app\models\Cor;
use app\models\Fotografia;
use app\models\FotografiaProduto;
use app\models\Material;
use app\models\Produto;
use yii\data\ActiveDataProvider;

class ProdutoRest extends Produto
{/*
    const SCENARIO_LOJA = 'loja';

    public function scenarios()
    {
        return [
            self::SCENARIO_LOJA => ['tituloArtigo', 'idMaterial0', 'idCor0', 'preco'],
        ];
    }*/

    public function dadosListar($params)
    {
        $query = ProdutoRest::find();
        //  ->innerJoinWith('idCor0');
        //->joinWith(['idMaterial0']);


        $dataProvider = new ActiveDataProvider([
            'query'=>$query,
            'pagination' => [
                'pageSize' => 7,
            ],
        ]);

        $this->load($params, "");


        return $dataProvider;
    }

    public function fields(){

        return ['id', 'tituloArtigo', 'na_loja', 'Res_Compressao', 'Res_Flexao', 'Massa_Vol_Aparente', 'Absorcao_Agua', 'idMaterial0', 'idCor0', 'preco', 'descricaoProduto',
            'quantidade_vendida' => function ($model) {return $model->quantidadeVendida($model->id);}, 'numero_pedidos' => function ($model)
            { return $model->numeroPedidos($model->id);}
        ];

        /*
                switch ($this->scenario) {
                    case 'loja':
                        return ['tituloArtigo', 'idMaterial0', 'idCor0', 'preco'  ];

            default:
                return ['idMaterial0','na_loja', 'Res_Compressao', 'Res_Flexao', 'Massa_Vol_Aparente', 'Absorcao_Agua', ];
        }*/
    }

    public function extraFields()
    {
        return ['id', 'url_fotografia' => function ($model) {$modelFotografiaProduto = FotografiaProduto::find()->where(["idProduto" => $model->id])->one();$picUrl = Fotografia::findOne($modelFotografiaProduto->idFotografia); return $picUrl->link; }];
    }

    public static function listarProdutosLoja(){
        $query = ProdutoRest::find()->where(['na_loja' => 1]);

        $dataProvider = new ActiveDataProvider([
            'query'=>$query,
            'pagination' => [
                'pageSize' => 12,
            ],
        ]);

        return $dataProvider;
    }

    public static function listarProdutosLojaTodos(){
        $query = ProdutoRest::find()->where(['na_loja' => 1]);

        $dataProvider = new ActiveDataProvider([
            'query'=>$query,
            'pagination' => false
        ]);

        return $dataProvider;
    }


    public function getIdMaterial0()
    {
        return $this->hasOne(MaterialRest::className(), ['id' => 'idMaterial']);
    }



    public function getIdCor0()
    {
        return $this->hasOne(CorRest::className(), ['id' => 'idCor']);
    }



}