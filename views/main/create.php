<?php
declare(strict_types = 1);

use app\modules\CQExample\models\ExamplePeoples;
use yii\helpers\Html;
use yii\web\View;

/**
 * @var View $this
 * @var ExamplePeoples $model
 */

$this->title = 'Create Example Peoples';
$this->params['breadcrumbs'][] = ['label' => 'Example Peoples', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="example-peoples-create">

	<h1><?= Html::encode($this->title) ?></h1>

	<?= $this->render('_form', [
		'model' => $model,
	]) ?>

</div>
