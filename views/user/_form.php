<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <div class="col-xs-12">

                <?php $form = ActiveForm::begin(); ?>

                <div class="box box-info">
                        <div class="box-header with-border">
                            
                        </div>
                        <div class="box-body">
                            <div class="row">  
                            </div>
                            
                        <div class="col-md-4">

                            <?= $form->field($model, 'user_id')->textInput(['maxlength' => true]) ?>

                        </div>

                        <div class="col-md-4">

                            <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>

                        </div>

                        <div class="col-md-4">

                            <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>

                        </div>

                         <div class="col-md-4">

                            <?= $form->field($model, 'email_id')->textInput(['maxlength' => true]) ?>

                        </div>

                        <div class="col-md-4">

                            <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>

                        </div>

                         <div class="col-md-4">

                            <?= $form->field($model, 'user_type_id')->dropDownList(ArrayHelper::map(\app\models\UserType::find()->all(),
                                'user_type_id','user_type_id'),['prompt'=> 'Select User Type Id']) ?>

                        </div>

                        

                        <div class="col-md-4">

                            <?= $form->field($model, 'department_id')->dropDownList(ArrayHelper::map(\app\models\Department::find()->all(),
                                'department_id','department_id'),['prompt'=> 'Select Department Id']) ?>

                        </div>


                    </div></div></div></div></div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
