<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\TireModelManufacturer */

$this->title = $model->id_model;
$this->params['breadcrumbs'][] = ['label' => 'Модели шин производителей', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

?>
<div class="tire-model-manufacturer-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Обновить', ['update', 'id_model' => $model->id_model, 'id_manufacturer' => $model->id_manufacturer], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id_model' => $model->id_model, 'id_manufacturer' => $model->id_manufacturer], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы действительно хотите удалить данную запись?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'id_model',
            // 'id_manufacturer',
            [
                'label' =>  'Модель',
                'value' => (isset($model->model->model_name) ? $model->model->model_name : ''),
            ],
            [
                'label' =>  'Производитель',
                'value'=> (isset($model->manufacturer->name) ? $model->manufacturer->name : ''),
            ],
        ],
    ]) ?>

</div>
