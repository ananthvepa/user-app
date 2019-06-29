<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = 'Create User';
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-create">

    <h2 style="color:#337ab7"><?= Html::encode($this->title) ?></h2> </br>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
