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
        <div class="col-3" style="">
            <?php

            echo Nav::widget([
                'options' => ['class' => 'd-flex flex-column'],
                'items' => [
                    ['label' => 'Perfil', 'url' => ['/perfil/meu-perfil']],
                    ['label' => 'Definicoes', 'url' => ['/perfil/definicoes']],
                    Yii::$app->user->isGuest ? (
                    ['label' => 'Login', 'url' => ['/user/login']]
                    ) : (
                        '<li>'
                        . Html::beginForm(['/site/logout'], 'post', ['class' => 'form-inline'])
                        . Html::submitButton(
                            'Terminar Sessão',
                            ['class' => 'btn btn-link logout nav-link',
                             'style' => 'color:black'],
                        )
                        . Html::endForm()
                        . '</li>'
                    )


                ],
            ]);

            ?>
        </div>
        <div class="col-9">
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