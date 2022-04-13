<?php

use yii\helpers\Html;
use yii\helpers\Url;


/* @var $this yii\web\View */

$this->title = 'Home';
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="dashboard-home">
    <div class="row">
        <div class="col-2" style="">
            <?=
            $this->render('_navbarLeft', []);
            ?>
        </div>
    </div>
</div>