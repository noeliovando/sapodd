<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\search\EstadisticaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="estadistica-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_actividad') ?>

    <?= $form->field($model, 'codigo_caso') ?>

    <?= $form->field($model, 'id_analista') ?>

    <?= $form->field($model, 'id_subproceso') ?>

    <?= $form->field($model, 'id_usuario') ?>

    <?php // echo $form->field($model, 'id_via') ?>

    <?php // echo $form->field($model, 'id_bd') ?>

    <?php // echo $form->field($model, 'id_organizacion') ?>

    <?php // echo $form->field($model, 'id_distrito') ?>

    <?php // echo $form->field($model, 'id_empresa') ?>

    <?php // echo $form->field($model, 'id_proyecto') ?>

    <?php // echo $form->field($model, 'id_proy_ep') ?>

    <?php // echo $form->field($model, 'id_dato_cargado') ?>

    <?php // echo $form->field($model, 'ndlis') ?>

    <?php // echo $form->field($model, 'nlis') ?>

    <?php // echo $form->field($model, 'nlas') ?>

    <?php // echo $form->field($model, 'ntiff') ?>

    <?php // echo $form->field($model, 'npdf') ?>

    <?php // echo $form->field($model, 'npds') ?>

    <?php // echo $form->field($model, 'id_anio_pozo') ?>

    <?php // echo $form->field($model, 'id_macro') ?>

    <?php // echo $form->field($model, 'id_detallada') ?>

    <?php // echo $form->field($model, 'fecha_requerimiento') ?>

    <?php // echo $form->field($model, 'hora_requerimiento') ?>

    <?php // echo $form->field($model, 'fecha_atencion') ?>

    <?php // echo $form->field($model, 'hora_ini') ?>

    <?php // echo $form->field($model, 'hora_fin') ?>

    <?php // echo $form->field($model, 'HH') ?>

    <?php // echo $form->field($model, 'id_status') ?>

    <?php // echo $form->field($model, 'detalle') ?>

    <?php // echo $form->field($model, 'pozo') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
