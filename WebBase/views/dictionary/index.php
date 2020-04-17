<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DictionarySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Dictionaries';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dictionary-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Dictionary', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'DictionaryId',
            'UserId',
            'DirctionaryTypeId',
            'keyword',
            'type',
            //'value',
            //'discription',
            //'is_defaule',
            //'create_date',
            //'last_update',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>