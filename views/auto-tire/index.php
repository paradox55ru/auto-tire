<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Автошины';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="auto-tire-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?='' //Html::a('Создать автошину', ['create'], ['class' => 'btn btn-success']) ?>

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
            [
                'class' => 'yii\grid\ActionColumn',
                'header'=>'Действия',
                //'headerOptions' => ['width' => '80'],
                'template' => '{view} {update} {delete}',
            ]

            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
