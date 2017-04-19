<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
?>
<h1>Парсер товаров с AliExpress и Ebay</h1><br>

<?php $form = ActiveForm::begin() ?>
<?= $form->field($url, 'path') ?>
<?= Html::submitButton('Парсить', ['class' => 'btn btn-success']) ?>
<?php ActiveForm::end() ?>

<h2><?php echo $parser[0]; ?></h2>
<p><?= $parser[1] ?></p>
<p>Цена товара: <?= $parser[2] ?><em>(Ali в рублях, Ebay в долларах)</em></p>
<p>Цена доставки: <?= $parser[3] ?></p>
<p>Конечная цена: <?= ($parser[2]*$percent)+$parser[3] ?><em>(Цена+Доставка+Процент)</em></p>
<a href="/create" class="btn btn-primary">Добавить товар в базу</a>

<h2>Курс Валют:</h2>
<p>1 USD: <?= $course[0] ?> RUB</p>
<p>1 EUR: <?= $course[1] ?> RUB</p>
<p>10 UAH: <?= $course[2] ?> RUB</p>

<h1>Список товаров</h1>

<div>
	<ul>
        <?php foreach ($arrayInView as $item): ?>
			<p>
				<?php $form1 = ActiveForm::begin() ?>
				<a href="/site/view/<?=$item->id?>"><?php echo $item->title?></a>
                <?php ActiveForm::end() ?>
			</p>
        <?php endforeach ?>
	</ul>
</div>