<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\ServiceOrderSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="service-order-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'user_id') ?>

    <?= $form->field($model, 'manager_id') ?>

    <?= $form->field($model, 'status_id') ?>

    <?= $form->field($model, 'name_service') ?>

    <?php // echo $form->field($model, 'description') ?>

    <?php // echo $form->field($model, 'company') ?>

    <?php // echo $form->field($model, 'place') ?>

    <?php // echo $form->field($model, 'address') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
