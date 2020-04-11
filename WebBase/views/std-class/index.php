<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\StdClassSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Std Classes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="std-class-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Std Class', ['create'], ['class' => 'btn btn-success']) ?>
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

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
