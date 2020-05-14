<?php
declare(strict_types = 1);

use app\modules\CQExample\models\ExamplePeoples;
use app\modules\CQExample\models\ExamplePeoplesSearch;
use app\modules\CQExample\models\ExamplePets;
use pozitronik\widgets\BadgeWidget;
use yii\data\ActiveDataProvider;
use yii\grid\SerialColumn;
use yii\grid\ActionColumn;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\web\View;

/**
 * @var View $this
 * @var ExamplePeoplesSearch $searchModel
 * @var ActiveDataProvider $dataProvider
 */

$this->title = 'Example Peoples';
$this->params['breadcrumbs'][] = $this->title;
$dataProvider->pagination = false;
?>
<div class="example-peoples-index">

	<h1><?= Html::encode($this->title) ?></h1>

	<p>
		<?= Html::a('Create Example Peoples', ['create'], ['class' => 'btn btn-success']) ?>
	</p>

	<?= GridView::widget([
		'dataProvider' => $dataProvider,
		'filterModel' => $searchModel,
		'columns' => [
			[
				'class' => SerialColumn::class
			],
			[
				'attribute' => 'id',
			],
			[
				'attribute' => 'name',
			],
			[
				'attribute' => 'age',
			],
			[
				'attribute' => 'petsName',
				'value' => function(ExamplePeoples $model) {
					return BadgeWidget::widget([
						'models' => $model->pets,
						'attribute' => 'name',
						'itemsSeparator' => false,
						'badgeOptions' => [
							'class' => 'badge badge-info'
						],
						'badgePostfix' => function(ExamplePets $model) {
							return ' '.BadgeWidget::widget([
								'models' => $model->refType,
								'badgeOptions' => [
									'class' => 'badge badge-warning'
								],
								'attribute' => 'name'
							]);
						}
					]);
				},
				'format' => 'raw'
			],
			[
				'attribute' => 'petsType',
				'value' => function(ExamplePeoples $model) {
					return BadgeWidget::widget([
						'models' => $model->pets,
						'useBadges' => false,
						'attribute' => 'refType.name'
					]);
				},
				'format' => 'raw'
			],

			[
				'class' => ActionColumn::class
			],
		],
	]) ?>
</div>
