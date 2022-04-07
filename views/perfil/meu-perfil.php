<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $modelPerfil app\controllers\PerfilController
/* @var $this yii\web\View */

$this->title = 'Meu Perfil';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="perfil-meu-perfil">
    <h1>Meu Perfil</h1>

    <?= $this->render('_formMeuPerfil', [
        'modelPerfil' => $modelPerfil,
    ]) ?>

</div>