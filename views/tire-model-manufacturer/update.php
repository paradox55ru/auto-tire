<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TireModelManufacturer */
/* @var $tireModels app\models\TireModel */
/* @var $manufacturer app\models\Manufacturer */

$this->title = 'Обновить модель шины производителя: ' . $model->id_model;
$this->params['breadcrumbs'][] = ['label' => 'Модели шин производителей', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_model, 'url' => ['view', 'id_model' => $model->id_model, 'id_manufacturer' => $model->id_manufacturer]];
$this->params['breadcrumbs'][] = 'Обновить';
?>
<div class="tire-model-manufacturer-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'tireModels' => $tireModels,
        'manufacturer' => $manufacturer,
    ]) ?>

</div>
