<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\ServiceOrderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Service Orders';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="service-order-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Service Order', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'status_id',
            'name_service',
            'company',
            // 'description:ntext',

            // 'place',
            // 'address',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
