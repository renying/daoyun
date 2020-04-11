<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\DictionaryType */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="dictionary-type-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'DirctionaryTypeId')->textInput() ?>

    <?= $form->field($model, 'name')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
