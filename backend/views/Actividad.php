<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Actividad */
/* @var $form ActiveForm */
?>
<div class="Actividad">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'codigo_caso') ?>
        <?= $form->field($model, 'id_analista') ?>
        <?= $form->field($model, 'id_subproceso') ?>
        <?= $form->field($model, 'id_usuario') ?>
        <?= $form->field($model, 'id_via') ?>
        <?= $form->field($model, 'id_bd') ?>
        <?= $form->field($model, 'id_organizacion') ?>
        <?= $form->field($model, 'id_distrito') ?>
        <?= $form->field($model, 'id_empresa') ?>
        <?= $form->field($model, 'id_proyecto') ?>
        <?= $form->field($model, 'id_proy_ep') ?>
        <?= $form->field($model, 'id_dato_cargado') ?>
        <?= $form->field($model, 'id_macro') ?>
        <?= $form->field($model, 'id_detallada') ?>
        <?= $form->field($model, 'fecha_requerimiento') ?>
        <?= $form->field($model, 'hora_requerimiento') ?>
        <?= $form->field($model, 'fecha_ini_aten') ?>
        <?= $form->field($model, 'hora_ini') ?>
        <?= $form->field($model, 'fecha_fin_aten') ?>
        <?= $form->field($model, 'hora_fin') ?>
        <?= $form->field($model, 'HH') ?>
        <?= $form->field($model, 'id_status') ?>
        <?= $form->field($model, 'detalle') ?>
        <?= $form->field($model, 'ndlis') ?>
        <?= $form->field($model, 'nlis') ?>
        <?= $form->field($model, 'nlas') ?>
        <?= $form->field($model, 'ntiff') ?>
        <?= $form->field($model, 'npdf') ?>
        <?= $form->field($model, 'npds') ?>
        <?= $form->field($model, 'id_anio_pozo') ?>
        <?= $form->field($model, 'pozo') ?>
    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- Actividad -->
