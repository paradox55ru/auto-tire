<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\AutoTire */
/* @var $tireModels app\models\TireModel */
/* @var $form yii\widgets\ActiveForm */

$this->title = 'Создать Автошину';
$this->params['breadcrumbs'][] = ['label' => 'Автошины', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$modelItems = ArrayHelper::map($tireModels->find()->all(),'id','model_name');
?>

<div class="auto-tire-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="auto-tire-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'width')->textInput() ?>

        <?= $form->field($model, 'profile')->textInput() ?>

        <?= $form->field($model, 'diameter')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'load_index')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'speed_index')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'id_model')->dropDownList($modelItems) ?>

        <?= $form->field($model, 'quantity')->textInput() ?>

        <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>

        <div class="form-group">
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>
