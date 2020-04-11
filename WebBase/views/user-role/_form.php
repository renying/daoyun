<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\UserRole */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-role-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Id')->textInput() ?>

    <?= $form->field($model, 'UserId')->textInput() ?>

    <?= $form->field($model, 'RoleId')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
