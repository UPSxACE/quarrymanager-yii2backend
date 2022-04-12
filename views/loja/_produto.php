<?php
use app\models\Produto;

/* @var Produto $model                     ------>                variável $model é automatica do yii2; convém adicionar*/
?>
<div class="m-5" style="background-color:grey">
    <img width="240px" height="160px" src="/uploads/<?=$model->idFotografia0->link?>">
    <div class="row">
        <?php $formatter = \Yii::$app->formatter; ?>
        <span class="col-6"><?=$model->tituloArtigo?></span>
        <span class="col-6 text-right"><?=$formatter->asCurrency($model->preco)?></span>
    </div>
</div>


<!--
    <h1>Produto:<?=$model->tituloArtigo?></h1>
    <h2>Material:<?=$model->idMaterial0->nome?></h2>
    <h2>Cor:<?=$model->idCor0->nome?></h2>
-->



