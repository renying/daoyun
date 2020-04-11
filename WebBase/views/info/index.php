<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\InfoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Infos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="info-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Info', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'info_id',
            'UserId',
            'RoleId',
            'info_content',
            'type',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
