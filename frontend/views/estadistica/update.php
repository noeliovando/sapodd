<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Estadistica */

$this->title = 'Update Estadistica: ' . ' ' . $model->id_actividad;
$this->params['breadcrumbs'][] = ['label' => 'Estadisticas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_actividad, 'url' => ['view', 'id' => $model->id_actividad]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="estadistica-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
