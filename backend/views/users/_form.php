<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Users */
/* @var $form yii\widgets\ActiveForm */
/* @var $listFirm array of backend\models\Firms */
/* @var $listRoles array of backend\models\Roles */
?>

<div class="users-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true,'autofocus' => true]) ?>

    <?= $form->field($model, 'password_hash')->passwordInput() ?>

    <?= $form->field($model, 'firstname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'lastname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

    <?php $mergeArray= array_merge(array('0' => 'Select firm'), $listFirm);   ?>

    <?= $form->field($model, 'firm_id')->dropdownList($mergeArray)->label('Firma'); ?>

    <?= $form->field($model, 'role_id')->dropdownList($listRoles); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
