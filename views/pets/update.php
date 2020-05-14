<?php
declare(strict_types = 1);

use yii\helpers\Html;

/* @var yii\web\View $this */
/* @var app\modules\CQExample\models\ExamplePets $model */

$this->title = 'Update Example Pets: '.$model->name;
$this->params['breadcrumbs'][] = ['label' => 'Example Pets', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="example-pets-update">

	<h1><?= Html::encode($this->title) ?></h1>

	<?= $this->render('_form', [
		'model' => $model,
	]) ?>

</div>
