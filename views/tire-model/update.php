<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TireModel */

$this->title = 'Обновить модель шины: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Модели шин', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Обновить';
?>
<div class="tire-model-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
