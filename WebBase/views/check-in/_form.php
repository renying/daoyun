<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CheckIn */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="check-in-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id')->textInput() ?>

    <?= $form->field($model, 'UserId')->textInput() ?>

    <?= $form->field($model, 'ClassId')->textInput() ?>

    <?= $form->field($model, 'CheckDate')->textInput() ?>

    <?= $form->field($model, 'CheckState')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
