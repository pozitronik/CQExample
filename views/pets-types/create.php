<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\CQExample\models\ExampleRefPetsTypes */

$this->title = 'Create Example Ref Pets Types';
$this->params['breadcrumbs'][] = ['label' => 'Example Ref Pets Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="example-ref-pets-types-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
