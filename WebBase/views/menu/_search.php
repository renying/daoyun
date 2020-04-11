<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\MenuSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="menu-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'Id') ?>

    <?= $form->field($model, 'Right_Key') ?>

    <?= $form->field($model, 'ParentKey') ?>

    <?= $form->field($model, 'Right_Url') ?>

    <?= $form->field($model, 'Right_Name') ?>

    <?php // echo $form->field($model, 'Right_Type') ?>

    <?php // echo $form->field($model, 'Right_Status') ?>

    <?php // echo $form->field($model, 'SortIndex') ?>

    <?php // echo $form->field($model, 'AddTime') ?>

    <?php // echo $form->field($model, 'LastUpdate') ?>

    <?php // echo $form->field($model, 'IconUrl') ?>

    <?php // echo $form->field($model, 'AddUser') ?>

    <?php // echo $form->field($model, 'IsDefaultRight') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
