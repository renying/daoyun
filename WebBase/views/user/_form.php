<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'UserId')->textInput() ?>

    <?= $form->field($model, 'UserName')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'NickName')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'BornDate')->textInput() ?>

    <?= $form->field($model, 'CountryId')->textInput() ?>

    <?= $form->field($model, 'Address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'SchoolId')->textInput() ?>

    <?= $form->field($model, 'Phone')->textInput() ?>

    <?= $form->field($model, 'UserCode')->textInput() ?>

    <?= $form->field($model, 'RealName')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'UserType')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
