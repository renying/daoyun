<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ClassTable */

$this->title = 'Update Class Table: ' . $model->ClassId;
$this->params['breadcrumbs'][] = ['label' => 'Class Tables', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ClassId, 'url' => ['view', 'id' => $model->ClassId]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="class-table-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
