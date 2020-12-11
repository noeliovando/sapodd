<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Estadistica */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="estadistica-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'codigo_caso')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_analista')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_subproceso')->textInput() ?>

    <?= $form->field($model, 'id_usuario')->textInput() ?>

    <?= $form->field($model, 'id_via')->textInput() ?>

    <?= $form->field($model, 'id_bd')->textInput() ?>

    <?= $form->field($model, 'id_organizacion')->textInput() ?>

    <?= $form->field($model, 'id_distrito')->textInput() ?>

    <?= $form->field($model, 'id_empresa')->textInput() ?>

    <?= $form->field($model, 'id_proyecto')->textInput() ?>

    <?= $form->field($model, 'id_proy_ep')->textInput() ?>

    <?= $form->field($model, 'id_dato_cargado')->textInput() ?>

    <?= $form->field($model, 'ndlis')->textInput() ?>

    <?= $form->field($model, 'nlis')->textInput() ?>

    <?= $form->field($model, 'nlas')->textInput() ?>

    <?= $form->field($model, 'ntiff')->textInput() ?>

    <?= $form->field($model, 'npdf')->textInput() ?>

    <?= $form->field($model, 'npds')->textInput() ?>

    <?= $form->field($model, 'id_anio_pozo')->textInput() ?>

    <?= $form->field($model, 'id_macro')->textInput() ?>

    <?= $form->field($model, 'id_detallada')->textInput() ?>

    <?= $form->field($model, 'fecha_requerimiento')->textInput() ?>

    <?= $form->field($model, 'hora_requerimiento')->textInput() ?>

    <?= $form->field($model, 'fecha_atencion')->textInput() ?>

    <?= $form->field($model, 'hora_ini')->textInput() ?>

    <?= $form->field($model, 'hora_fin')->textInput() ?>

    <?= $form->field($model, 'HH')->textInput() ?>

    <?= $form->field($model, 'id_status')->textInput() ?>

    <?= $form->field($model, 'detalle')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'pozo')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
