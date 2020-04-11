<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ClassTable */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="class-table-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ClassId')->textInput() ?>

    <?= $form->field($model, 'UserId')->textInput() ?>

    <?= $form->field($model, 'ClassNum')->textInput() ?>

    <?= $form->field($model, 'ClassDiscription')->textInput() ?>

    <?= $form->field($model, 'CreateTime')->textInput() ?>

    <?= $form->field($model, 'UpdateTime')->textInput() ?>

    <?= $form->field($model, 'LastUpdateUserId')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
