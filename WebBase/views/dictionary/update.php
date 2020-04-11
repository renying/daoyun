<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Dictionary */

$this->title = 'Update Dictionary: ' . $model->DictionaryId;
$this->params['breadcrumbs'][] = ['label' => 'Dictionaries', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->DictionaryId, 'url' => ['view', 'id' => $model->DictionaryId]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="dictionary-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
