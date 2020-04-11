<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\UserRightSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-right-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'Right_Key') ?>

    <?= $form->field($model, 'Enable_Flag') ?>

    <?= $form->field($model, 'Id') ?>

    <?= $form->field($model, 'UserId') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
