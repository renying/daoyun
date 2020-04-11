<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\UserRight */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-right-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Right_Key')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Enable_Flag')->textInput() ?>

    <?= $form->field($model, 'Id')->textInput() ?>

    <?= $form->field($model, 'UserId')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
