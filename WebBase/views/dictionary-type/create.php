<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\DictionaryType */

$this->title = 'Create Dictionary Type';
$this->params['breadcrumbs'][] = ['label' => 'Dictionary Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dictionary-type-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
