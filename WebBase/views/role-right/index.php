<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\RoleRightSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Role Rights';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="role-right-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Role Right', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'Right_Key',
            'RoleId',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
