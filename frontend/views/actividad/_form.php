<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use kartik\date\DatePicker;
use kartik\time\TimePicker;
use yii\helpers\StringHelper;


/* @var $this yii\web\View */
/* @var $model frontend\models\Actividad */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="actividad-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="form-group">

        <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Modificar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    <div class="row">
        <div class="col-lg-2">
            <?php if($model->isNewRecord) {
                echo $form->field($model, 'codigo_caso')->textInput(['readonly' => true, 'value' => $model->getCodigoActividad()], ['maxlength' => true]);
            }
            else{
                echo $form->field($model, 'codigo_caso')->textInput(['readonly' => true, 'value' => $model->codigo_caso], ['maxlength' => true]);
            } ?>
        </div>

        <div class="col-lg-2">
            <?= $form->field($model, 'id_status')->dropDownList($model->getStatus()) ?>
        </div>

        <div class="col-lg-2">
            <?= $form->field($model, 'id_analista')->dropDownList($model->getAnalista()) ?>
        </div>

        <div class="col-lg-4">
            <?= $form->field($model, 'id_subproceso')->dropDownList($model->getSubproceso()) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-2">
            <?= $form->field($model, 'id_usuario')->dropDownList($model->getUsuario()) ?>
        </div>

        <div class="col-lg-2">
            <?= $form->field($model, 'id_via')->dropDownList($model->getSolicitudVia()) ?>
        </div>

        <div class="col-lg-3">
            <?= $form->field($model, 'id_bd')->dropDownList($aplicaciones) ?>
        </div>
    </div>
    <?= $form->field($model, 'id_proyecto')->dropDownList($model->getProyecto()) ?>
    <?= $form->field($model, 'id_dato_cargado')->dropDownList($model->getDatoCargado()) ?>


    <?php
    echo $form->field($model, 'id_macro')->dropDownList($model->getActividadMacro(),
        ['prompt'=>'Seleccione una actividad Macro',
            'onchange'=>'
            $.get( "'.Url::toRoute('dependent-dropdown/detallada').'", { id: $(this).val() } )
            .done(function( data ) {
             $( "select#id_detallada" ).html( data );
            }
            );'
        ]);

    ?>
    <?php
    echo $form->field($model, 'id_detallada')
        ->dropDownList(
            $model->getActividadDetallada(),
            ['prompt'=>'Seleccione una actividad Detallada',
                'id'=>'id_detallada'
            ]
        );
    ?>
    <div class="row">
        <div class="col-lg-6">
            <?php
            if(StringHelper::explode(date('Y/m/d'),'/')[2]>26){
                $fecha=StringHelper::explode(date('Y/m/d'),'/')[0].'/' .(StringHelper::explode(date('Y/m/d'),'/')[1]).'-26';
            }elseif(StringHelper::explode(date('Y/m/d'),'/')[1]==1)
                $fecha=(StringHelper::explode(date('Y/m/d'),'/')[0]-1).'/' .(StringHelper::explode(date('Y/m/d'),'/')[1]-1).'-26';
            else
                $fecha=StringHelper::explode(date('Y/m/d'),'/')[0].'/' .(StringHelper::explode(date('Y/m/d'),'/')[1]-1).'-26';
            echo $form->field($model, 'fecha_requerimiento')->widget(DatePicker::className(),
                [
                    'name' => 'fecha_requerimiento',
                    'type' => DatePicker::TYPE_COMPONENT_PREPEND,
                    'value' => date('Y/m/d'),
                    'readonly' => true,
                    'language' => 'es',
                    'options' => ['placeholder' => 'Seleccione una fecha ...'],
                    'pluginOptions' => [
                        'format' => 'yyyy/mm/dd',
                        'autoclose' => true,
                        'daysOfWeekDisabled' => [0, 6],
                        //'startDate'=>$fecha,
                        //'startDate'=>date('Y/m/d'),
                        'todayHighlight' => true
                    ]
                ]);?>
        </div>
        <div class="col-lg-6">

            <?= $form->field($model, 'hora_requerimiento')->widget(TimePicker::className([]),[
                'pluginOptions' => [
                    'showMeridian' => false,
                    'minuteStep' => 5,
                ]
            ]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <?= $form->field($model, 'fecha_atencion')->widget(DatePicker::className(),
                [
                    'name' => 'fecha_ini_aten',
                    'type' => DatePicker::TYPE_COMPONENT_PREPEND,
                    'value' => date('Y/m/d'),
                    'readonly' => true,
                    'language' => 'es',
                    'options' => ['placeholder' => 'Seleccione una fecha ...'],
                    'pluginOptions' => [
                        'format' => 'yyyy/mm/dd',
                        'autoclose' => true,
                        'daysOfWeekDisabled' => [0, 6],
                        //'startDate'=>$fecha,
                        //'startDate'=>date('Y/m/d'),
                        'todayHighlight' => true
                    ]
                ]); ?>
        </div>
        <div class="col-lg-6">

            <?= $form->field($model, 'hora_ini')->widget(TimePicker::className(),[
                'pluginOptions' => [
                    'showMeridian' => false,
                    'minuteStep' => 5,
                ]
            ]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">

        </div>
        <div class="col-lg-6">
            <?= $form->field($model, 'hora_fin')->widget(TimePicker::className(),[
                'pluginOptions' => [
                    'showMeridian' => false,
                    'minuteStep' => 5,
                ]
            ]) ?>
        </div>
    </div>

    <?php // $form->field($model, 'HH')->textInput(['id'=>'HH']) ?>



    <?= $form->field($model, 'detalle')->textarea(['rows' => 6]) ?>



    <div class="form-group">

        <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Modificar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>