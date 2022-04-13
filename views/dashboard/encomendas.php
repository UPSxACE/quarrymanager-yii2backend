<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;


/* @var $this yii\web\View */

$this->title = 'Encomendas';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="dashboard-encomendas">
    <h1>Encomendas</h1>
</div>

<?php

$texto = "teste";

echo GridView::widget([
    'dataProvider' => $listaEncomendas,
    'columns' => [
        [
            'class' => 'yii\grid\DataColumn', // this line is optional
            'attribute' => 'idEstado0.nome',
            'format'=>'text',
            'label' => 'Status',
        ],
        [
            'class' => 'yii\grid\DataColumn', // this line is optional
            //'attribute' => 'idMaterial',
            'attribute' => 'idPedido0.id',
            'format' => 'text',
            'label' => 'ID Encomenda',
        ],
        [
            'class' => 'yii\grid\DataColumn', // this line is optional
            //'attribute' => 'idMaterial',
            'attribute' => 'dataEstado',
            'format' => 'text',
            'label' => 'Ultima Atualização',
        ],
        [
            'class' => 'yii\grid\DataColumn', // this line is optional
            //'attribute' => 'idMaterial',
            'attribute' => 'idPedido0.idUser0.username',
            'format' => 'text',
            'label' => 'Cliente',
        ],
        [
            'class' => 'yii\grid\DataColumn', // this line is optional
            'attribute' => 'idPedido0.idProduto0.tituloArtigo',
            //'value' => function(){return "teste";},
            'format' => 'text',
            'label' => 'Produto',
        ],
    ]
]);
?>