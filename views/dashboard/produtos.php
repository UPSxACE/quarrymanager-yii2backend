<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;


/* @var $this yii\web\View */
/* @var $listaProdutos \app\controllers\DashboardController */

$this->title = 'Produtos';
$this->params['breadcrumbs'][] = $this->title;
?>

    <div class="dashboard-produtos">
        <h1>Produtos</h1>
    </div>

<?php

$texto = "teste";

echo GridView::widget([
    'dataProvider' => $listaProdutos,
    'columns' => [
        [
            'class' => 'yii\grid\DataColumn', // this line is optional
            'attribute' => 'na_loja',
            'format'=>'boolean',
            'label' => 'Na Loja',
        ],
        [
            'class' => 'yii\grid\DataColumn', // this line is optional
            'attribute' => 'idMaterial0.nome',
            'format'=>'text',
            'label' => 'Material',
        ],
        [
            'class' => 'yii\grid\DataColumn', // this line is optional
            //'attribute' => 'idMaterial',
            'attribute' => 'idCor0.nome',
            'format' => 'text',
            'label' => 'Cor',
        ],
        [
            'class' => 'yii\grid\DataColumn', // this line is optional
            //'attribute' => 'idMaterial',
            'attribute' => 'idProduto0.Res_Compressao',
            'format' => 'text',
            'label' => 'Resistência à Compressão',
        ],
        [
            'class' => 'yii\grid\DataColumn', // this line is optional
            //'attribute' => 'idMaterial',
            'attribute' => 'idProduto0.Res_Flexao',
            'format' => 'text',
            'label' => 'Resistência à Flexão',
        ],
        [
            'class' => 'yii\grid\DataColumn', // this line is optional
            //'attribute' => 'idMaterial',
            'attribute' => 'idProduto0.Massa_Vol_Aparente',
            'format' => 'text',
            'label' => 'Massa Volúmica Aparente',
        ],
        [
            'class' => 'yii\grid\DataColumn', // this line is optional
            //'attribute' => 'idMaterial',
            'attribute' => 'idProduto0.Absorcao_Agua',
            'format' => 'text',
            'label' => 'Absorção de Água',
        ],
    ]
]);
?>