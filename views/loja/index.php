<?php

use app\models\Loja;
use app\models\Produto;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProdutoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $listaProdutos \yii\data\ActiveDataProvider*/

$this->title = 'Loja';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="loja-index">
  <h1><?= Html::encode($this->title) ?></h1>

    <?php

    /*foreach($listaProdutos as $produto){
        $tituloProduto = $produto->tituloArtigo;
        echo "<h2>" . $tituloProduto . "<h1>";
    }
    */
    //echo "<h2>" . $carro . "<h1>"; teste

    echo GridView::widget([
        'dataProvider' => $listaProdutos,
        /*
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'class' => 'yii\grid\DataColumn', // this line is optional
                'attribute' => 'name',
                'format' => 'text',
                'label' => 'Name',
            ],
            ['class' => 'yii\grid\CheckboxColumn'],
        ]
        */
        'columns' => [
            [
                'class' => 'yii\grid\DataColumn', // this line is optional
                'attribute' => 'tituloArtigo',
                'format'=>'text',
                'label' => 'Produto',
            ],
            [
                'class' => 'yii\grid\DataColumn', // this line is optional
                //'attribute' => 'idMaterial',
                'attribute' => 'idMaterial0.nome',
                'format' => 'text',
                'label' => 'Material',
            ],
            [
                'class' => 'yii\grid\DataColumn', // this line is optional
                //'attribute' => 'idMaterial',
                'attribute' => 'idCor0.nome',
                'format' => 'text',
                'label' => 'Côr',
            ],
            [
                'class' => 'yii\grid\DataColumn', // this line is optional
                'attribute' => 'preco',
                'format'=>'currency',
                'label' => 'Preco',
            ],
        ]
    ]);
    ?>

    <?php
        echo \yii\widgets\ListView::widget([
                'dataProvider' => $listaProdutos,
                'itemView' => '_produto',             //para cada entrada da base de dados, vai ser aplicado o código deste view
                'options' => [
                        'class' => 'row'
                ],
                'itemOptions' => [
                        'class' => 'col-4'
                ],
                'layout' => "<div class='row'>{summary}</div><div class='row'>{items}</div><div class='row'>{pager}</div>"
        ])
    ?>
</div>
