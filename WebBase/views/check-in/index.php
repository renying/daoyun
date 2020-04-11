<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CheckInSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Check Ins';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="check-in-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Check In', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'UserId',
            'ClassId',
            'CheckDate',
            'CheckState',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
