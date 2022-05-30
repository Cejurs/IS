<?php
use yii\grid\GridView;
use yii\bootstrap4\Html;

$this->registerCssFile('/css/view.css');
echo GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' =>[
        'id',
        'name',
        'email',
        'subject',
        'status',
        [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{reply}',
            'buttons' => [
                'reply' => function ($url,$model,$key) {
                        return Html::a('Reply', $url, ['class' => 'btn btn-success btn-xs']);
                    },
            ],
        ],
    ]
    ]);
