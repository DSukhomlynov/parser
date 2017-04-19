<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
?>
<h1>Админка</h1>
<a href="/admin/default/create" class="btn btn-primary">Создать</a>
<table class="table">
	<thead>
	<tr>
		<td>#</td>
		<td>Название</td>
		<td>Действия</td>
	</tr>
	</thead>

	<tbody>
		<?php foreach($model as $item): ?>
			<tr>
				<td><?=$item->id?></td>
				<td><?=$item->title?></td>
				<td>
					<a href="/admin/default/edit/<?=$item->id?>">Редактировать</a>
					|
					<a href="/admin/default/delete/<?=$item->id?>">Удалить</a>
				</td>
			</tr>
		<?php endforeach; ?>
		<br><br>
	</tbody>

</table>

	<h3>Фиксированный процент магазина</h3>
<?php foreach($percentage as $percent): ?>
	<tr>
		<td><?='Текущий процент:  '?></td>
		<td><?=$percent->percentage?>%</td>
		<br>
		<td>
			<a href="/admin/default/editpers">Редактировать</a>
		</td>
	</tr>
<?php endforeach; ?>