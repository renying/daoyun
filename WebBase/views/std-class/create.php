<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\StdClass */

$this->title = 'Create Std Class';
$this->params['breadcrumbs'][] = ['label' => 'Std Classes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="std-class-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
