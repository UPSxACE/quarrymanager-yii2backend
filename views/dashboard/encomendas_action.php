<?php

use yii\bootstrap4\Nav;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;


/* @var $this yii\web\View */

$this->title = 'Encomenda #' . str_pad($modelEncomenda->id, 6, '0', STR_PAD_LEFT);
$this->params['breadcrumbs'][] = $this->title;
$context = 0;
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

        </div>
        <div class="container-fluid mt-4">
            <div class="row">
                <!-- nav -->
                <?= $this->render('_actionNav', ['modelEncomenda' => $modelEncomenda, 'context' => $context]) ?>
            </div>
            <div class="row">
                <!-- conteudo -->
                <div class="col-12 dashboardDiv mb-5">
                    <div class="row pl-5 pr-5 pb-5 pt-5">
                        <div class="col-6 pl-0 pr-3">
                            <?= $this->render('_encomendaTooltip', ['modelEncomenda' => $modelEncomenda]) ?>
                        </div>
                        <div class="col-6 d-flex justify-content-end">
                            <div class="d-flex flex-column text-right pr-3">
                                <h2><?= $modelEncomenda->idUser0->profile0->full_name ?></h2>
                                <h6>Encomenda Nº <?= $modelEncomenda->id ?> </h6>
                                <h6>Pedido realizado em: <?= $modelEncomenda->dataHoraPedido ?> </h6>
                            </div>
                            <img height="110px" width="110px" src="/uploads/<?= $modelEncomenda->idUser0->profile0->idFotografia0->link ?>">

                            <!-- <img height="110px" width="110px" src="/uploads/profilePictures/genericUserProfilePicture.svg"> -->
                        </div>
                    </div>
                    <div class="row pl-5 pr-5 pb-5">
                        <div class="col-6">
                            <div class="row h-100 pr-3">
                                <div class="col-12 p-0">
                                    <a class="btn btn-secondary rounded-0 nav-item">Editar</a>
                                </div>
                                <div class="col-12 dashboardInnerDiv" style="height: 416px;">
                                    <div class="row p-2">
                                        <div class="col-6 pb-2">
                                            <h6 class="font-weight-bold">Nome:</h6>
                                            <h6><?= $modelEncomenda->idUser0->profile0->full_name ?></h6>
                                        </div>
                                        <div class="col-6 pb-2">
                                            <h6 class="font-weight-bold">Morada:</h6>
                                            <h6><?= $modelEncomenda->idUser0->profile0->morada ?></h6>
                                        </div>
                                        <div class="col-6 pb-2">
                                            <h6 class="font-weight-bold">Email:</h6>
                                            <h6><?= $modelEncomenda->idUser0->profile0->email ?></h6>
                                        </div>
                                        <div class="col-6 pb-2">
                                            <h6 class="font-weight-bold">Telefone:</h6>
                                            <h6><?= $modelEncomenda->idUser0->profile0->telefone ?></h6>
                                        </div>
                                        <div class="col-12 pb-2">
                                            <span style="text-decoration: underline;">Detalhes da Conta do Utilizador</span>
                                        </div>
                                        <div class="col-12 pb-2">
                                            <textarea class="w-100" style="height: 200px" readonly><?= $modelEncomenda->mensagem ?></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="row h-100 pl-3">
                                <div class="col-12 p-0">
                                    <a class="btn btn-secondary rounded-0 nav-item">Editar</a>
                                </div>
                                <div class="col-12 dashboardInnerDiv" style="height: 416px;">
                                    <div class="row p-2">
                                        <div class="col-6 pb-2">
                                            <h6 class="font-weight-bold">Produto:</h6>
                                            <h6><?= $modelEncomenda->idProduto0->tituloArtigo ?></h6>
                                        </div>
                                        <div class="col-6 pb-2">
                                            <h6 class="font-weight-bold">Preço/m²:</h6>
                                            <h6><?= $modelEncomenda->idProduto0->preco ?></h6>
                                        </div>
                                        <div class="col-6 pb-2">
                                            <h6 class="font-weight-bold">Quantidade:</h6>
                                            <h6><?= $modelEncomenda->quantidade ?></h6>
                                        </div>
                                        <div class="col-6 pb-2">
                                            <h6 class="font-weight-bold">Código de Desconto::</h6>
                                            <h6><?= $modelEncomenda->codigo_desconto ?></h6>
                                        </div>
                                        <div class="col-6 pb-2">
                                            <h6 class="font-weight-bold">Preço Inicial:</h6>
                                            <h6><?= $modelEncomenda->idProduto0->preco ?></h6>
                                        </div>
                                        <div class="col-6 pb-2">
                                            <h6 class="font-weight-bold">Desconto (Manual):</h6>
                                            <h6><?= $modelEncomenda->desconto ?></h6>
                                        </div>
                                        </div>
                                        <div class="col-6 pb-2">
                                            <h6 class="font-weight-bold">Estimativa Preço Final:</h6>
                                            <h6><?= ($modelEncomenda->idProduto0->preco)-($modelEncomenda->desconto) ?></h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>



                </div>
            </div>
        </div>


    </div>
</div>