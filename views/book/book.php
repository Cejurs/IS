<?php

use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;

$this->title = 'Book';
$this->params['breadcrumbs'][] = $this->title;
?>
<?php if (Yii::$app->session->hasFlash('BookFormSubmitted')): ?>

<div class="alert alert-success">
    Appartment was succesfully booked.
</div>
<?php elseif (Yii::$app->session->hasFlash('ApartamentBooked')): ?>
<div class="alert alert-success">
    Sorry but Appartment was booked by someone else.
</div>
<?php else: ?>
<div class="book">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to book room:</p>

    <?php $form = ActiveForm::begin([
        'id' => 'book-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n{input}\n{error}",
            'labelOptions' => ['class' => 'col-lg-1 col-form-label mr-lg-3'],
            'inputOptions' => ['class' => 'col-lg-3 form-control'],
            'errorOptions' => ['class' => 'col-lg-7 invalid-feedback'],
        ],
    ]); ?>


        <?= $form->field($model, 'monthcount')->input('number', ['min' => 1, 'max' => 24])->label('Month Count') ?>

        <div class="form-group">
            <div class="offset-lg-1 col-lg-11">
                <?= Html::submitButton('Book', ['class' => 'btn btn-primary', 'name' => 'book-button']) ?>
            </div>
        </div>
    <?php ActiveForm::end(); ?>

    <div class="offset-lg-1" style="color:#999;">
    </div>
</div>
<?php endif; ?>
