<?php
use yii\grid\GridView;
use yii\bootstrap4\Html;

$this->registerCssFile('/css/view.css');
echo GridView::widget([
    'dataProvider' => $dataProvider,
    ]);