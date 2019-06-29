<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = 'Update User: ' . $model->first_name . ' ' . $model->last_name ;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->user_id, 'url' => ['view', 'id' => $model->user_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="user-update">

    <h3 style="color:#337ab7"><?= Html::encode($this->title) ?></h3> </br>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
