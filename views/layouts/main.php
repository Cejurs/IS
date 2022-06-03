<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap4\Breadcrumbs;
use yii\bootstrap4\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

<header>
    <?php
    NavBar::begin([
        'brandLabel' => "RentApp", //Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar navbar-expand-md navbar-dark bg-dark fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav'],
        'items' => [
            ['label' => 'Home', 'url' => ['/site/index']],
            ['label' => 'Account', 'url' => ['/site/account']],
            ['label' => 'Contact', 'url' => ['/site/contact']],
            [
                'label' => 'AdminPanel',
                 'visible' => Yii::$app->user->identity->role==='ADMIN',
                 'items' => [
                    ['label' => 'Support', 'url' => ['/admin/index']],
                    ['label' => 'Add Appartment', 'url' => ['/admin/add-apartment']],
                    ['label' => 'Deals', 'url' => ['/admin/get-deals']],
                 ]

            ],
            Yii::$app->user->isGuest ? (
                [
                    'label' => 'Authorization',
                     'items' => [
                         ['label' => 'SignUp', 'url' => ['/site/signup']],
                         ['label' => 'Login', 'url' => ['/site/login']],
                        ],
                ]
            ) : (
                ['label'=> 'Logout('.Yii::$app->user->identity->userName.')','url'=>['/site/logout']]
            )
        ],
    ]);
    NavBar::end();
    ?>
</header>

<main role="main" class="flex-shrink-0">
    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</main>

<footer class="footer mt-auto py-3 text-muted">
    <div class="container">
        <p class="float-left">&copy; My Company <?= date('Y') ?></p>
        <p class="float-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
