<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\DictionaryType */

$this->title = 'Update Dictionary Type: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Dictionary Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->DirctionaryTypeId]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="dictionary-type-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
