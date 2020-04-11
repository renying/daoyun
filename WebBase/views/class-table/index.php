<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ClassTableSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Class Tables';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="class-table-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Class Table', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'ClassId',
            'UserId',
            'ClassNum',
            'ClassDiscription',
            'CreateTime',
            //'UpdateTime',
            //'LastUpdateUserId',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
