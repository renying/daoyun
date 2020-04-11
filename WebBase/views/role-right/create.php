<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RoleRight */

$this->title = 'Create Role Right';
$this->params['breadcrumbs'][] = ['label' => 'Role Rights', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="role-right-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
