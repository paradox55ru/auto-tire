<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AutoTire */
/* @var $manufacturer app\models\Manufacturer */
/* @var $tireModelsManufacturer app\models\TireModelManufacturer */

$this->title = 'Обновить Автошину: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Автошины', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Обновить';
?>
<div class="auto-tire-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'manufacturer' => $manufacturer,
        'tireModelsManufacturer' => $tireModelsManufacturer
    ]) ?>

</div>
