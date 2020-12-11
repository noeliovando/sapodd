<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Actividad */

$this->title = 'Modificar Actividad: ' . ' ' . $model->id_actividad;
$this->params['breadcrumbs'][] = ['label' => 'Actividads', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_actividad, 'url' => ['view', 'id' => $model->id_actividad]];
$this->params['breadcrumbs'][] = 'Modificar';
?>
<div class="actividad-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'aplicaciones'=>$aplicaciones,
    ]) ?>

</div>
