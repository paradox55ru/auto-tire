<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\AutoTire */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Автошины', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

\yii\web\YiiAsset::register($this);
?>
<div class="auto-tire-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Обновить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
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
            'id',
            'name',
            'width',
            'profile',
            'diameter',
            'load_index',
            'speed_index',
            [
                'label' =>  'Модель',
                'value' => (isset($model->tireModel->model->model_name) ? $model->tireModel->model->model_name : ''),
            ],
            [
                'label' =>  'Производитель',
                'value'=> (isset($model->tireModel->manufacturer->name) ? $model->tireModel->manufacturer->name : ''),
            ],
            'quantity',
            'price',
            [
                'attribute' => 'create_at',
                'format' =>  function($create_at) {
                    return date('d.m.Y', strtotime($create_at));
                },
            ],
            [
                'attribute' => 'update_at',
                'format' =>  function($update_at) {
                    return $update_at ? date('d.m.Y', strtotime($update_at)) : '';
                },
            ],
            //'by_edit:boolean',
        ],
    ]) ?>

</div>
