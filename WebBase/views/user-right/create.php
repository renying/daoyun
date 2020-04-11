<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\UserRight */

$this->title = 'Create User Right';
$this->params['breadcrumbs'][] = ['label' => 'User Rights', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-right-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
