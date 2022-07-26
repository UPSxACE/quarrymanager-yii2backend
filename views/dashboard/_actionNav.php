<?php use yii\bootstrap4\Nav;


switch($context){
    case 0: // dados da encomenda
        //$isolated_button = ['label' => 'Validar', 'url' => ['/dashboard/stock'], 'options' => ['class' => 'btn btn-secondary rounded-0 ml-auto']];
        $isolated_button = ['label' => 'Cancelar Encomenda', 'url' => ['/dashboard/encomendas/'. $modelEncomenda->id . '/cancelar'], 'options' => ['class' => 'btn btn-secondary rounded-0 ml-auto']];
        break;
    case 1: // mobilização do stock
        $isolated_button = ['label' => 'Agendar Recolha', 'url' => ['/dashboard/encomendas/' . $modelEncomenda->id . '/agendar-recolha/'], 'options' => ['class' => 'btn btn-secondary rounded-0 ml-auto']];
        break;
    default:
        $isolated_button = ['label' => '???', 'options' => ['class' => 'btn btn-secondary rounded-0 ml-auto']];
}

echo Nav::widget([
    'options' => ['class' => 'd-flex flex-row w-100', 'id' => 'encomendaNav'],
    'items' => [

        ['label' => 'Dados Da Encomenda', 'url' => ['/dashboard/encomendas/' . $modelEncomenda->id], 'options' => ['class' => 'btn btn-secondary rounded-0 mr-1']],
        ['label' => 'Mobilização do Stock', 'url' => ['/dashboard/encomendas/' . $modelEncomenda->id . '/mobilizacao/'], 'options' => ['class' => 'btn btn-secondary rounded-0 mr-1']],
        //['label' => 'Cancelar Encomenda', 'url' => ['/dashboard/encomendas/'], 'options' => ['class' => 'btn btn-secondary rounded-0 mr-1']],
        $isolated_button
    ]
]); ?><?php
