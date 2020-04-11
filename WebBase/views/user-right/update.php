<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\UserRight */

$this->title = 'Update User Right: ' . $model->Id;
$this->params['breadcrumbs'][] = ['label' => 'User Rights', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Id, 'url' => ['view', 'id' => $model->Id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="user-right-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
