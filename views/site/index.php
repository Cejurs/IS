<?php

/** @var yii\web\View $this */

$this->title = 'RentApp';
use yii\grid\GridView;
use yii\bootstrap4\Html;
use yii\widgets\LinkPager;
$this->registerCssFile('/css/view.css');
?>
<ul class="apartments clearfix">
            <?php
            foreach($models as $model)
            {
                 echo "<li class='product-wrapper'>";
                 echo "<div class='product-photo'>";
                 echo "<img alt='' src=".$model->img.">";
                 echo "</div>";
                 echo" <h4 >".$model->name."</h4>";
                 echo "<h5 >".$model->square."m²</h5>";
                 echo "<p >".$model->description."</p>";
                 echo "<p >".$model->monthrent."$</p>";
                 echo "<div class='link'>";
                 echo"<a href='/site/view?id=".$model->id."'>View</a>";
                 echo "</div>";
                 echo "<div class='link'>";
                 echo"<a href='/book/book?id=".$model->id."'>Book</a>";
                 echo "</div>";
                echo"</li>";
            }
            ?>
    </ul>
    <?php
    echo LinkPager::widget([
    'pagination' => $pages,
]);
