<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $modelPerfil app\controllers\PerfilController
/* @var $this yii\web\View */

$this->title = 'Meu Perfil';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="perfil-meu-perfil">
    <div class="row">
        <div class="col-3">BOTOES</div>
        <div class="col-9">
            <h1>Meu Perfil</h1>
            <?= $this->render('_formMeuPerfil', [
                'modelPerfil' => $modelPerfil,
            ]) ?>
        </div>
    </div>
</div>