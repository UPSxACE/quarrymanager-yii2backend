<?php

use yii\bootstrap4\Html;
use yii\bootstrap4\Nav;


?>

    <?php echo Nav::widget([
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
                        'style' => 'color:#007bff'],
                )
                . Html::endForm()
                . '</li>'
            )


        ],
    ]); ?>


