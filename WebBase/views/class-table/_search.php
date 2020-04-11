<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ClassTableSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="class-table-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'ClassId') ?>

    <?= $form->field($model, 'UserId') ?>

    <?= $form->field($model, 'ClassNum') ?>

    <?= $form->field($model, 'ClassDiscription') ?>

    <?= $form->field($model, 'CreateTime') ?>

    <?php // echo $form->field($model, 'UpdateTime') ?>

    <?php // echo $form->field($model, 'LastUpdateUserId') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
