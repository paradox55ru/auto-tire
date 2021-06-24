<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\TireModelManufacturer */
/* @var $form yii\widgets\ActiveForm */
/* @var $tireModels app\models\TireModel */
/* @var $manufacturer app\models\Manufacturer */

$modelItems = ArrayHelper::map($tireModels->find()->all(),'id','model_name');

$manufacturerItems = ArrayHelper::map($manufacturer->find()->all(),'id','name');

$modelId = 0;
if (isset($model->model->id)) {
    $modelId = $model->model->id;
}

$modelIdOptions = [
    'options' => [
        $modelId => [
            'selected' => 'selected',
        ],
    ],
    'class' => "form-control"
];

$manufacturerId = 0;
if (isset($model->manufacturer->id)) {
    $manufacturerId = $model->manufacturer->id;
}

$manufacturerOptions = [
    'options' => [
        $manufacturerId => [
            'selected' => 'selected',
        ],
    ],
    'class' => "form-control"
];
?>

<div class="tire-model-manufacturer-form">

    <?php $form = ActiveForm::begin(); ?>

    <?='' //$form->field($model, 'id_model')->textInput() ?>

    <?='' //$form->field($model, 'id_manufacturer')->textInput() ?>

    <div class="form-group field-tiremodelmanufacturer-id_model required">
        <?= html::activeLabel($tireModels, 'model_name') ?>
        <?= html::activeDropDownList($model, 'id_model', $modelItems, $modelIdOptions) ?>
    </div>

    <div class="form-group field-tiremodelmanufacturer-id_manufacturer required">
        <?= html::activeLabel($manufacturer, 'name') ?>
        <?= html::activeDropDownList($model, 'id_manufacturer', $manufacturerItems, $manufacturerOptions) ?>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
