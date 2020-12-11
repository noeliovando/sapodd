<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Analista */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="analista-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php
    $opciones = \yii\helpers\ArrayHelper::map($tipoAplicaciones, 'id', 'nombre');
    echo $form->field($model, 'aplicaciones')->checkboxList($opciones,['separator' => '<br>'], ['unselect'=>NULL]);

    ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Modificar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
