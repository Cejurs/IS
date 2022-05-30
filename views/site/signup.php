<?php 

use yii\bootstrap4\Html;
use yii\bootstrap4\ActiveForm;

$this->title = 'SignUp';
$this->params['breadcrumbs'][] = $this->title;

?>
<p>Please fill out the following fields to singup:</p>
<?php $form= ActiveForm::begin([
        'id' => 'signup-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n{input}\n{error}",
            'labelOptions' => ['class' => 'col-lg-1 col-form-label mr-lg-3'],
            'inputOptions' => ['class' => 'col-lg-3 form-control'],
            'errorOptions' => ['class' => 'col-lg-7 invalid-feedback'],
        ],
    ]) ?>
<?= $form->field($model,'username') ?>
<?= $form->field($model,'email') ?>
<?= $form->field($model,'password')->passwordInput() ?>
<div class="form-group">
            <div class="offset-lg-1 col-lg-11">
                <?= Html::submitButton('SignUp', ['class' => 'btn btn-success', 'name' => 'signUp-button']) ?>
            </div>
        </div>
<?php ActiveForm::end() ?>