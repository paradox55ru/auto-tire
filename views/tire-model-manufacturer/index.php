<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Модели шин производителей';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="tire-model-manufacturer-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Создать связь модели шины с производителем', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            //'id_manufacturer',
            [
                'format' => 'text',
                'label' =>  'Производитель',
                'content'=>function($model) {
                    return isset($model->manufacturer->name) ? $model->manufacturer->name : '';
                }
            ],
            //'id_model',
            [
                'format' => 'text',
                'label' =>  'Модель',
                'content'=>function($model) {
                    return isset($model->model->model_name) ? $model->model->model_name : '';
                }
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
