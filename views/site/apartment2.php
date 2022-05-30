<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
//$this->registerCssFile('/css/view.css');
?>
<div class="post">
    <h2><?= Html::encode($model->name) ?></h2>

    <?= Html::img($model->img) ?>
    <?= HtmlPurifier::process($model->adress) ?>
    <p> Описание </p>
    <?= HtmlPurifier::process($model->description) ?>
</div>