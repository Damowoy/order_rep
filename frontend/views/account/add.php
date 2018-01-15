<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'Add bid';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="account-bid">
    <h1><?= Html::encode($this->title) ?></h1>


    <div class="row">
        <div class="col-lg-5">

            <?php $form = ActiveForm::begin(['id' => 'bid-form']); ?>

            <?= $form->field($model, 'name_service')->textInput(['autofocus' => true])->label('Name service')  ?>

            <?= $form->field($model, 'description')->textarea(['rows' => 6])->label('Description')  ?>

            <?= $form->field($model, 'company')->label('Name company')  ?>

            <?= $form->field($model, 'place')->label('Place')  ?>

            <?= $form->field($model, 'address')->label('Address')  ?>

            <?= $form->field($model, 'status_id')->dropdownList($statusList); ?>

            <?= $form->field($model, 'user_id')->textInput(['value'=>Yii::$app->user->id])->label(''); ?>
 <!--'type'=>'hidden', -->
            <div class="form-group">
                <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>

</div>
