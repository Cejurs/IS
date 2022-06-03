<?php
$this->registerCssFile('/css/card.css');
use yii\bootstrap4\Html;
use yii\bootstrap4\ActiveForm;

$this->title = 'Wallet';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container-1">
	<div class="product">
		<h3>Balance</h3>
		<p><?php echo $model->money ?></p>

        <h3>Penalty</h3>
		<p><?php echo $model->penalty ?></p>
		
	</div>
    <?php $form = ActiveForm::begin(['id' => 'money-form']); ?>
    <?= $form->field($addmodel, 'sum')->input('number',['min' => 10])->label("Add Money") ?>
<div class="form-group">
    <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
</div>

<?php ActiveForm::end(); ?>

</div>
