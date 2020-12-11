<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Usuarios */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="usuarios-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-lg-3">
            <?= $form->field($model, 'nombre') ?>
        </div>
        <div class="col-lg-3">
            <?= $form->field($model, 'apellido') ?>
        </div>
        <div class="col-lg-3">
            <?= $form->field($model, 'indicador') ?>
        </div>
        <div class="col-lg-3">
            <?= $form->field($model, 'cedula') ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3">
            <?= $form->field($model, 'correo') ?>
        </div>
        <div class="col-lg-3">
            <?= $form->field($model, 'telefono') ?>
        </div>
        <div class="col-lg-3">
            <?= $form->field($model, 'supervisor') ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-2">
            <?= $form->field($model, 'id_division')->dropDownList($model->getDivisiones()) ?>
        </div>
        <div class="col-lg-2">
            <?= $form->field($model, 'id_organizacion')->dropDownList($model->getOrganizaciones()) ?>
        </div>
        <div class="col-lg-2">
            <?= $form->field($model, 'id_empresa')->dropDownList($model->getEmpresas()) ?>
        </div>
        <div class="col-lg-2">
            <?= $form->field($model, 'departamento') ?>
        </div>
    </div>
    <?= $form->field($model, 'id_aplicacion')->dropDownList($model->getAplicaciones()) ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Modificar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
