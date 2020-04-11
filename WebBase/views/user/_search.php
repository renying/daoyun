<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\UserSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'UserId') ?>

    <?= $form->field($model, 'UserName') ?>

    <?= $form->field($model, 'NickName') ?>

    <?= $form->field($model, 'BornDate') ?>

    <?= $form->field($model, 'CountryId') ?>

    <?php // echo $form->field($model, 'Address') ?>

    <?php // echo $form->field($model, 'SchoolId') ?>

    <?php // echo $form->field($model, 'Phone') ?>

    <?php // echo $form->field($model, 'UserCode') ?>

    <?php // echo $form->field($model, 'RealName') ?>

    <?php // echo $form->field($model, 'UserType') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
