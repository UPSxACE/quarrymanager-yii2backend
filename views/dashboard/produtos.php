<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;


/* @var $this yii\web\View */
/* @var $listaProdutos \app\controllers\DashboardController */

$this->title = 'Produtos';
$this->params['breadcrumbs'][] = $this->title;
?>

    <div class="dashboard-produtos row">
        <div class="col-2">
            <?= $this->render('_navbarLeft') ?>
        </div>
        <div class="col-10">
            <div class="d-flex align-items-center w-100">
                <h1>Produtos</h1>
                <a style="margin-left:auto" href="/dashboard/novo-produto"><button type="button" class="btn btn-primary" style="height:100%">Novo Produto</button></a>
            </div>
            <?php

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
                        'attribute' => 'Res_Compressao',
                        'format' => 'text',
                        'label' => 'Res. à Compressão',
                    ],
                    [
                        'class' => 'yii\grid\DataColumn', // this line is optional
                        //'attribute' => 'idMaterial',
                        'attribute' => 'Res_Flexao',
                        'format' => 'text',
                        'label' => 'Res. à Flexão',
                    ],
                    [
                        'class' => 'yii\grid\DataColumn', // this line is optional
                        //'attribute' => 'idMaterial',
                        'attribute' => 'Massa_Vol_Aparente',
                        'format' => 'text',
                        'label' => 'Massa Vol. Aparente',
                    ],
                    [
                        'class' => 'yii\grid\DataColumn', // this line is optional
                        //'attribute' => 'idMaterial',
                        'attribute' => 'Absorcao_Agua',
                        'format' => 'text',
                        'label' => 'Absorção de Água',
                    ],
                ]
            ]);
            ?>
        </div>
    </div>

