<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Dictionary */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="dictionary-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'DictionaryId')->textInput() ?>

    <?= $form->field($model, 'UserId')->textInput() ?>

    <?= $form->field($model, 'DirctionaryTypeId')->textInput() ?>

    <?= $form->field($model, 'keyword')->textInput() ?>

    <?= $form->field($model, 'type')->textInput() ?>

    <?= $form->field($model, 'value')->textInput() ?>

    <?= $form->field($model, 'discription')->textInput() ?>

    <?= $form->field($model, 'is_defaule')->textInput() ?>

    <?= $form->field($model, 'create_date')->textInput() ?>

    <?= $form->field($model, 'last_update')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
