<?php

use yii\bootstrap4\Nav;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;


/* @var $this yii\web\View */

$this->title = 'Encomenda #' . str_pad($modelEncomenda->id, 6, '0', STR_PAD_LEFT);
$this->params['breadcrumbs'][] = $this->title;
$context = 1;
?>




<div class="dashboard-encomenda-action row">
    <div class="col-2">
        <?= $this->render('_navbarLeft') ?>
    </div>
    <div class="col-10">

        <div class="row">
            <div class="col-12">
                <div class="d-flex align-items-center w-100">
                    <h1><?= $this->title ?></h1>
                </div>
            </div>
            <!-- isto vai se tornar CONDICIONAL -->
            <div class="col-12">
                <div class="bd-callout bd-callout-warning">
                    <h4>Há <mark>5</mark> pedidos <mark>em espera</mark>.</h4>
                </div>
            </div>
        </div>
        <div class="container-fluid mt-4">
            <div class="row">
                <!-- nav -->
                <?= $this->render('_actionNav', ['modelEncomenda' => $modelEncomenda, 'context' => $context]) ?>
            </div>
            <div class="row">
                <!-- conteudo -->
                <div class="col-12 dashboardDiv mb-5">
                    <div class="row p-5">
                        <div class="col-12">
                            <div class="pb-5">
                                <span class="h2">Produto: </span><span class="h2 font-weight-normal"><?= $modelEncomenda->idProduto0->tituloArtigo ?></span>
                                <br>
                                <span class="h6"><i>O</i> </span><span class="h6">Stock Disponível: </span><span>??</span><span>m² </span><span>(Suficiente)</span>
                                <br>
                                <span class="h6"><i>O</i> </span><span class="h6">Reservado para a encomenda: </span><span>??</span><span></span><span>/</span><span></span><span>??</span><span>m² </span><span>(Suficiente)</span>
                            </div>
                            <?php

                            echo GridView::widget([
                                'dataProvider' => $listaPedidoLote,
                                'columns' => [
                                    [
                                        'class' => 'yii\grid\DataColumn', // this line is optional
                                        'attribute' => 'codigoLote',
                                        'format'=>'text',
                                        'label' => 'Lote',
                                    ],
                                    [
                                        'class' => 'yii\grid\DataColumn', // this line is optional
                                        'attribute' => 'quantidade',
                                        'format'=>'text',
                                        'label' => 'Quantidade',
                                    ],
                                    [
                                        'class' => 'yii\grid\DataColumn', // this line is optional
                                        'attribute' => 'codigoLote0.idLocalArmazem0.nome',
                                        'format'=>'text',
                                        'label' => 'Local',
                                    ],
                                    [
                                        'class' => 'yii\grid\DataColumn', // this line is optional
                                        'attribute' => 'dataHoraAgendamento',
                                        'format'=>'datetime',
                                        'label' => 'Data Agendamento',
                                    ],
                                    [
                                        'class' => 'yii\grid\DataColumn', // this line is optional
                                        //'attribute' => 'dataHoraAgendamento',
                                        'content' => function ($model, $key, $index, $column) {
                                            if($model->dataHoraRecolha === null){
                                                return '<h4 class="p-0 m-0">Não</h4><span style="text-decoration: underline">(Confirmar Recolha)</span>';
                                            } else
                                            return '<h4 class="p-0 m-0">Sim</h4><span style="text-decoration: underline">(Anular Recolha)</span>' ;
                                        },
                                        'format'=>'text',
                                        'label' => 'Recolhido',
                                    ],
                                ]
                            ]);
                            ?>
                        </div>
                    </div>





                </div>
            </div>
        </div>


    </div>
</div>