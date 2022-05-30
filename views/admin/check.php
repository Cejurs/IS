<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap4\ActiveForm $form */
/** @var app\models\ContactForm $model */

use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;

$this->title = 'Reply';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-reply">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php if (Yii::$app->session->hasFlash('ReplyFormSubmitted')): ?>

        <div class="alert alert-success">
            Reply is send to user.
        </div>
    <?php else: ?>

        <p>
            Fill reply form.
        </p>

        <div class="row">
            <div class="col-lg-11">

                <?php $form = ActiveForm::begin(['id' => 'reply-form']); ?>

                    <?= Html::activeLabel($model,'name') ?>
                    <p style='overflow-wrap:break-word;  border: 1px solid gray; padding: 6px;'> <?= $model->name ?> </p>

                    <?= Html::activeLabel($model,'email') ?>
                    <p style='overflow-wrap:break-word; border: 1px solid gray; padding: 6px;> <?= $model->email ?> </p>

                    <?= Html::activeLabel($model,'subject') ?>
                    <p style='overflow-wrap:break-word'> <?= $model->subject ?> </p>
                    <?= Html::activeLabel($model,'body') ?>
                    <p style='overflow-wrap:break-word; border: 1px solid gray; padding: 6px;'> <?= $model->body ?> </p>
                    <?= $form->field($model, 'reply')->textarea(['rows' => 6]) ?>

                    <div class="form-group">
                        <?= Html::submitButton('Reply', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                    </div>

                <?php ActiveForm::end(); ?>

            </div>
        </div>

    <?php endif; ?>
</div>