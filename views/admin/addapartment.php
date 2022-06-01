<?php 

use yii\bootstrap4\Html;
use yii\bootstrap4\ActiveForm;

$this->title = 'AddApartment';
$this->params['breadcrumbs'][] = $this->title;

?>
<?php if (Yii::$app->session->hasFlash('AddFormSubmitted')): ?>

<div class="alert alert-success">
    Appartment was added.
</div>
<?php else: ?>
<?php $form= ActiveForm::begin([
        'id' => 'add-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n{input}\n{error}",
            'labelOptions' => ['class' => 'col-lg-1 col-form-label mr-lg-3'],
            'inputOptions' => ['class' => 'col-lg-3 form-control'],
            'errorOptions' => ['class' => 'col-lg-7 invalid-feedback'],
        ],
    ]) ?>
<?= $form->field($model,'img')->fileInput() ?>
<?= $form->field($model,'name') ?>
<?= $form->field($model,'adress') ?>
<?= $form->field($model,'description') ?>
<?= $form->field($model, 'square')->input('number', ['min' => 0, 'max' => 1000]) ?>
<?= $form->field($model, 'monthrent')->input('number', ['min' => 10, 'max' => 100000])->label('Month Rent') ?>
<div class="form-group">
            <div class="offset-lg-1 col-lg-11">
                <?= Html::submitButton('AddApartment', ['class' => 'btn btn-success', 'name' => 'Add-button']) ?>
            </div>
        </div>
<?php ActiveForm::end() ?>
<?php endif; ?>