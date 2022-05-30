<?php 
use yii\widgets\DetailView;
?>
<h2 class="zag"> Заголовок</h2>
<?php
echo DetailView::widget([
    'model' => $model,
    'attributes' => [
        'id',
        'name' ,
        'adress',
        'description',
        'img:image'             
    ],
]);