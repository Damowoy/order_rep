<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\ServiceOrder */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Service Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="service-order-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
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
            'id',
            'user_id',
            'engener_id',
            'status_id',
            'name_service',
            'description:ntext',
            'company',
            'place',
            'address',
        ],
    ]) ?>

</div>
