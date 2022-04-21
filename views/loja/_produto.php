<?php
use app\models\Produto;

/* @var Produto $model                     ------>                variável $model é automatica do yii2; convém adicionar*/
?>
<div class="mb-4 d-flex w-100 flex-column" style="background-color:grey">
    <div class="row">
        <div class="col-12">
            <img class="align-self-center" width="100%" height="160px" style="object-fit: cover" src="/uploads/<?=$model->idFotografia0->link?>">
        </div>
    </div>

    <div class="row">
        <?php $formatter = \Yii::$app->formatter; ?>
        <span class="col-6"><a href="/loja/produto/<?= $model->id ?>" style="color:black"><?=$model->tituloArtigo?></a></span>
        <span class="col-6 text-right"><?= $model->preco ?>€/m²</span>
    </div>
</div>


<!--
    <h1>Produto:<?=$model->tituloArtigo?></h1>
    <h2>Material:<?=$model->idMaterial0->nome?></h2>
    <h2>Cor:<?=$model->idCor0->nome?></h2>
-->



