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
                    <div class="row pl-5 pr-5 pb-5 pt-5">
                        <div class="col-6 pl-0 pr-3">
                            <?= $this->render('_encomendaTooltip') ?>
                        </div>
                        <div class="col-6 d-flex justify-content-end">
                            <div class="d-flex flex-column text-right">
                                <h2>username</h2>
                                <h6>Encomenda NºX</h6>
                                <h6>Pedido realizado em: dd/mm/yyyy hh:mm</h6>
                            </div>
                            <img height="110px" width="110px" src="/uploads/profilePictures/genericUserProfilePicture.svg">
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
                                            <h6>??</h6>
                                        </div>
                                        <div class="col-6 pb-2">
                                            <h6 class="font-weight-bold">Morada:</h6>
                                            <h6>??</h6>
                                            <h6>??</h6>
                                        </div>
                                        <div class="col-6 pb-2">
                                            <h6 class="font-weight-bold">Email:</h6>
                                            <h6>??</h6>
                                        </div>
                                        <div class="col-6 pb-2">
                                            <h6 class="font-weight-bold">Telefone:</h6>
                                            <h6>??</h6>
                                        </div>
                                        <div class="col-12 pb-2">
                                            <span>Detalhes da Conta do Utilizador</span>
                                        </div>
                                        <div class="col-12 pb-2">
                                            <textarea class="w-100" style="height: 200px" value="???" readonly>??</textarea>
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
                                            <h6>??</h6>
                                        </div>
                                        <div class="col-6 pb-2">
                                            <h6 class="font-weight-bold">Preço/m²:</h6>
                                            <h6>??</h6>
                                            <h6>??</h6>
                                        </div>
                                        <div class="col-6 pb-2">
                                            <h6 class="font-weight-bold">Quantidade:</h6>
                                            <h6>??</h6>
                                        </div>
                                        <div class="col-6 pb-2">
                                            <h6 class="font-weight-bold">Código de Desconto::</h6>
                                            <h6>??</h6>
                                        </div>
                                        <div class="col-6 pb-2">
                                            <h6 class="font-weight-bold">Preço Inicial:</h6>
                                            <h6>??</h6>
                                        </div>
                                        <div class="col-6 pb-2">
                                            <h6 class="font-weight-bold">Desconto (Código):</h6>
                                            <h6>??</h6>
                                        </div>
                                        <div class="col-6 pb-2">
                                            <h6 class="font-weight-bold">Desconto (Manual):</h6>
                                            <h6>??</h6>
                                        </div>
                                        <div class="col-6 pb-2">
                                            <h6 class="font-weight-bold">Código de Desconto:</h6>
                                            <h6>??</h6>
                                        </div>
                                        <div class="col-6 pb-2">
                                            <h6 class="font-weight-bold">Estimativa Preço Final:</h6>
                                            <h6>??</h6>
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