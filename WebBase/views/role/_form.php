<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Role */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="role-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'RoleId')->textInput() ?>

    <?= $form->field($model, 'RoleName')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'CreateDate')->textInput() ?>

    <?= $form->field($model, 'Creator')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
