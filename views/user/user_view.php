<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users by View';
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <div class="tab-content"><h2 style="color:#337ab7"> Users by View </h2> </br>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'first_name',
            'last_name',
            'payable_salary',
            'basic_salary',
            'tax_value',
            'last_month_deduction',
            'user_type_name',
            'department_name',

            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
