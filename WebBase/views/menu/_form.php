<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Menu */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="menu-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Id')->textInput() ?>

    <?= $form->field($model, 'Right_Key')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ParentKey')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Right_Url')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Right_Name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Right_Type')->textInput() ?>

    <?= $form->field($model, 'Right_Status')->textInput() ?>

    <?= $form->field($model, 'SortIndex')->textInput() ?>

    <?= $form->field($model, 'AddTime')->textInput() ?>

    <?= $form->field($model, 'LastUpdate')->textInput() ?>

    <?= $form->field($model, 'IconUrl')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'AddUser')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'IsDefaultRight')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
