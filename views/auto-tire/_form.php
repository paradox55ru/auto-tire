<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\AutoTire */
/* @var $form yii\widgets\ActiveForm */
/* @var $tireModelsManufacturer app\models\TireModelManufacturer */
/* @var $manufacturer app\models\Manufacturer */

$tireModelsManufacturerItems = $tireModelsManufacturer->find()->with('model')->with('manufacturer')->all();

$modelItems = ArrayHelper::map($tireModelsManufacturerItems,'model.id','model.model_name');

$manufacturerItems = ArrayHelper::map($tireModelsManufacturerItems,'manufacturer.id','manufacturer.name');
$manufacturerId = 0;

if (isset($model->tireModel->manufacturer->id)) {
    $manufacturerId = $model->tireModel->manufacturer->id;
}

$manufacturerOptions = [
    'options' => [
        $manufacturerId => [
            'selected' => 'selected',
        ],
    ],
    'disabled' => true,
    'class' => "form-control"
];
?>

<div class="auto-tire-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'width')->textInput() ?>

    <?= $form->field($model, 'profile')->textInput() ?>

    <?= $form->field($model, 'diameter')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'load_index')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'speed_index')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_model')->dropDownList($modelItems) ?>

    <div class="form-group field-manufacturer-id">
        <?= html::activeLabel($manufacturer, 'name') ?>
        <?= html::activeDropDownList($manufacturer, 'id', $manufacturerItems, $manufacturerOptions) ?>
    </div>

    <?= $form->field($model, 'quantity')->textInput() ?>

    <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
