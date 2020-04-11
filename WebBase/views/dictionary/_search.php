<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\DictionarySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="dictionary-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'DictionaryId') ?>

    <?= $form->field($model, 'UserId') ?>

    <?= $form->field($model, 'DirctionaryTypeId') ?>

    <?= $form->field($model, 'keyword') ?>

    <?= $form->field($model, 'type') ?>

    <?php // echo $form->field($model, 'value') ?>

    <?php // echo $form->field($model, 'discription') ?>

    <?php // echo $form->field($model, 'is_defaule') ?>

    <?php // echo $form->field($model, 'create_date') ?>

    <?php // echo $form->field($model, 'last_update') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
