<?php
declare(strict_types = 1);

use app\modules\CQExample\models\ExamplePetsSearch;
use yii\data\ActiveDataProvider;
use yii\grid\SerialColumn;
use yii\grid\ActionColumn;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\web\View;

/**
 * @var View $this
 * @var ExamplePetsSearch $searchModel
 * @var ActiveDataProvider $dataProvider
 */

$this->title = 'Example Pets';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="example-pets-index">

	<h1><?= Html::encode($this->title) ?></h1>

	<p>
		<?= Html::a('Create Example Pets', ['create'], ['class' => 'btn btn-success']) ?>
	</p>

	<?= GridView::widget([
		'dataProvider' => $dataProvider,
		'filterModel' => $searchModel,
		'columns' => [
			['class' => SerialColumn::class],

			'id',
			'name',
			'type',

			['class' => ActionColumn::class],
		],
	]) ?>
</div>
