<?php

use app\models\Produto;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProdutoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $listaProdutos \yii\data\ActiveDataProvider*/

$this->title = 'Produto ' . $produto->id;
?>

<img height="500px" width="100%" style="object-fit: cover" src="/uploads/<?= $produto->idFotografia0->link ?>">
<div class="row">
    <div class="col-6">
        <h1><?= $produto->tituloArtigo ?></h1>
    </div>
    <div class="col-6">
        <h1 class="text-right"><?= $produto->preco ?> €/m²</h1>
    </div>
    <div class="d-flex align-items-center col-6">
        <p class="p-0 m-0"><?= $produto->descricaoProduto ?></p>
    </div>
    <div class="d-flex align-content-center col-6 flex-column">
        <div class="row">
            <span class="col-6 font-weight-bold">Resistência à Compressão</span><span class="col-6 text-right"><?= $produto->Res_Compressao ?> MPa</span>
            <span class="col-6 font-weight-bold">Resistência à Flexão</span><span class="col-6 text-right"><?= $produto->Res_Flexao ?> MPa</span>
            <span class="col-6 font-weight-bold">Massa Volúmica Aparente</span><span class="col-6 text-right"><?= $produto->Massa_Vol_Aparente ?> Kg/m²</span>
            <span class="col-6 font-weight-bold">Absorção de Água</span><span class="col-6 text-right"><?= $produto->Absorcao_Agua ?>%</span>
        </div>

    </div>

    <div class="container-fluid vw-100">
        <div class="row justify-content-center">
            <div class="col-9" style="background-color:grey">
                <h1 class="text-center">Orçamento</h1>
                <?php if(Yii::$app->session->hasFlash('Orcamento-success')): ?>
                    <div class="alert alert-success">
                        <?php echo Yii::$app->session->getFlash('Orcamento-success'); ?>
                    </div>
                <?php endif; ?>
                <?= $this->render('_formOrcamento',[
                    'modelPedido' => $modelPedido,
                    'modelPerfil' => $modelPerfil
                ]); ?>
            </div>
        </div>
    </div>

</div>
