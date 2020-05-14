<?php
declare(strict_types = 1);

use app\modules\CQExample\models\ExamplePeoples;
use yii\helpers\Html;
use yii\web\View;

/**
 * @var View $this
 * @var ExamplePeoples $model
 */

$this->title = 'Update Example Peoples: '.$model->name;
$this->params['breadcrumbs'][] = ['label' => 'Example Peoples', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="example-peoples-update">

	<h1><?= Html::encode($this->title) ?></h1>

	<?= $this->render('_form', [
		'model' => $model,
	]) ?>

</div>
