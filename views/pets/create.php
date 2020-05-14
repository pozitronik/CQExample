<?php
declare(strict_types = 1);

use yii\helpers\Html;

/* @var yii\web\View $this */
/* @var app\modules\CQExample\models\ExamplePets $model */

$this->title = 'Create Example Pets';
$this->params['breadcrumbs'][] = ['label' => 'Example Pets', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="example-pets-create">

	<h1><?= Html::encode($this->title) ?></h1>

	<?= $this->render('_form', [
		'model' => $model,
	]) ?>

</div>
