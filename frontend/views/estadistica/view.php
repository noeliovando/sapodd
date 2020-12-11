<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Estadistica */

$this->title = $model->id_actividad;
$this->params['breadcrumbs'][] = ['label' => 'Estadisticas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="estadistica-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id_actividad], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_actividad], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_actividad',
            'codigo_caso',
            'id_analista',
            'id_subproceso',
            'id_usuario',
            'id_via',
            'id_bd',
            'id_organizacion',
            'id_distrito',
            'id_empresa',
            'id_proyecto',
            'id_proy_ep',
            'id_dato_cargado',
            'ndlis',
            'nlis',
            'nlas',
            'ntiff',
            'npdf',
            'npds',
            'id_anio_pozo',
            'id_macro',
            'id_detallada',
            'fecha_requerimiento',
            'hora_requerimiento',
            'fecha_atencion',
            'hora_ini',
            'hora_fin',
            'HH',
            'id_status',
            'detalle:ntext',
            'pozo',
        ],
    ]) ?>

</div>
