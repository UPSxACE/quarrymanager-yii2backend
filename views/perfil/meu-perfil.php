<?php

use yii\bootstrap4\Nav;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $modelPerfil app\controllers\PerfilController
/* @var $this yii\web\View */

$this->title = 'Meu Perfil';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="perfil-meu-perfil">
    <div class="row">
        <div class="col-2" style="">
            <?=
            $this->render('_sidebar', []);
            ?>
        </div>
        <div class="col-10">
            <h1>Meu Perfil</h1>
            <?php if(Yii::$app->session->hasFlash('Account-success')): ?>

                <div class="alert alert-success">
                    <?php echo Yii::$app->session->getFlash('Account-success'); ?>
                </div>


            <?php endif; ?>
            <?= $this->render('_formMeuPerfil', [
                'modelPerfil' => $modelPerfil,
                'modelUpload' => $modelUpload
            ]) ?>
        </div>
    </div>
</div>