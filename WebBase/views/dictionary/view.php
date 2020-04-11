<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Dictionary */

$this->title = $model->DictionaryId;
$this->params['breadcrumbs'][] = ['label' => 'Dictionaries', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="dictionary-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->DictionaryId], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->DictionaryId], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'DictionaryId',
            'UserId',
            'DirctionaryTypeId',
            'keyword',
            'type',
            'value',
            'discription',
            'is_defaule',
            'create_date',
            'last_update',
        ],
    ]) ?>

</div>
