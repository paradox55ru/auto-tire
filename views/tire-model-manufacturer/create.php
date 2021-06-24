<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\TireModelManufacturer */
/* @var $tireModels app\models\TireModel */
/* @var $manufacturer app\models\Manufacturer */
/* @var $form yii\widgets\ActiveForm */

$this->title = 'Создать связь модели шины с производителем';
$this->params['breadcrumbs'][] = ['label' => 'Модели шины производителей', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$modelItems = ArrayHelper::map($tireModels->find()->all(),'id','model_name');

$manufacturerItems = ArrayHelper::map($manufacturer->find()->all(),'id','name');
?>

<div class="tire-model-manufacturer-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_model')->dropDownList($modelItems) ?>
    <?='' //$form->field($model, 'id_model')->textInput() ?>

    <?= $form->field($model, 'id_manufacturer')->dropDownList($manufacturerItems) ?>
    <?='' //$form->field($model, 'id_manufacturer')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>


<!-- div class="tire-model-manufacturer-create">

    <h1><?='' // Html::encode($this->title) ?></h1>

    <?=''  /*$this->render('_form', [
        'model' => $model,
        'tireModels' => $tireModels,
    ])*/ ?>

</div -->
