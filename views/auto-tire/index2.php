<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $by_edit $_GET */

$this->title = 'Автошины';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="auto-tire-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],
            'id',
            'name',
            'width',
            'profile',
            'diameter',
            'load_index',
            'speed_index',
            [
                'format' => 'text',
                'label' =>  'Производитель',
                'content'=>function($model) {
                    return isset($model->tireModel->manufacturer->name) ? $model->tireModel->manufacturer->name : '';
                }
            ],
            [
                'format' => 'text',
                'label' =>  'Модель',
                'content'=>function($model) {
                    return isset($model->tireModel->model->model_name) ? $model->tireModel->model->model_name : '';
                }
            ],
            'quantity',
            'price',
            [
                'attribute' => 'create_at',
                'format' =>  function($model) {
                    return date('d.m.Y', strtotime($model));
                },
            ],
            [
                'attribute' => 'update_at',
                'format' =>  function($model) {
                    return $model ? date('d.m.Y', strtotime($model)) : '';
                },
            ],
            //'by_edit:boolean',
        ],
    ]); ?>


</div>
