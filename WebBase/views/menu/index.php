<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\MenuSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Menus';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="menu-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Menu', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'Id',
            'Right_Key',
            'ParentKey',
            'Right_Url:url',
            'Right_Name',
            //'Right_Type',
            //'Right_Status',
            //'SortIndex',
            //'AddTime',
            //'LastUpdate',
            //'IconUrl',
            //'AddUser',
            //'IsDefaultRight',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
