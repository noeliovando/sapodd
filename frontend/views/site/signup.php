<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

$this->title = 'Registro de Usuario';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Por favor llene el siguiente formulario:</p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
            <?= $form->field($model, 'nombre') ?>
            <?= $form->field($model, 'apellido') ?>
            <?= $form->field($model, 'username') ?>
            <?= $form->field($model, 'email') ?>
            <?= $form->field($model, 'telefono') ?>
            <?= $form->field($model, 'password')->passwordInput() ?>
            <?= $form->field($model, 'password_repeat')->passwordInput() ?>
            <?= $form->field($model, 'cedula') ?>
            <?= $form->field($model, 'supervisor') ?>
            <?= $form->field($model, 'id_division')->dropDownList($model->getDivisiones()) ?>
            <?= $form->field($model, 'id_distrito')->dropDownList($model->getDistritos()) ?>
            <?= $form->field($model, 'id_organizacion')->dropDownList($model->getOrganizaciones()) ?>
            <?= $form->field($model, 'id_empresa')->dropDownList($model->getEmpresas()) ?>
            <?= $form->field($model, 'departamento') ?>
            <?= $form->field($model, 'id_aplicacion')->dropDownList($model->getAplicaciones()) ?>


                <div class="form-group">
                    <?= Html::submitButton('Registrar', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
