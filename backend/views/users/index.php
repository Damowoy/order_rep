<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\UsersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="users-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Users', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
   <!-- $modelRoles::findOne($id)->name -->
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'username',
            'firstname',
             'email:email',
                 ['header'  => "role",
                  'format'  => 'raw',
                  'content' => function ($data){

                   return $data::findOne($data->id)->roles[0]->name;
                  }

                 ],
            /* 'content'=>function($data){
                    print_r($data);
                    exit();
                    },*/
            ['class' => 'yii\grid\ActionColumn'],
        ],

    ]); ?>
</div>
