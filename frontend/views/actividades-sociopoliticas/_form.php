<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model frontend\models\ActividadesSociopoliticas */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="actividades-sociopoliticas-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'descripcion')->textarea(['rows' => 6]) ?>

    <?php echo $form->field($model, 'fecha')->widget(DatePicker::className(),
        [
            'name' => 'fecha',
            'type' => \kartik\date\DatePicker::TYPE_COMPONENT_PREPEND,
            'value' => date('Y/m/d'),
            'readonly' => true,
            'language' => 'es',
            'options' => ['placeholder' => date('Y/m/d')],
            'pluginOptions' => [
                'format' => 'yyyy/mm/dd',
                'autoclose' => true,
                'daysOfWeekDisabled' => [0, 6],
                'todayHighlight' => true
            ]
        ]);?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Modificar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
