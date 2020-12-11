<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Actividad */

$this->title = $model->codigo_caso;
$this->params['breadcrumbs'][] = ['label' => 'Actividads', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="actividad-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php if(Yii::$app->user->identity->rol_id=='3') echo Html::a('Modificar', ['update', 'id' => $model->id_actividad], ['class' => 'btn btn-primary']) ?>
        <?php if(Yii::$app->user->identity->rol_id=='3') echo Html::a('Eliminar', ['delete', 'id' => $model->id_actividad], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '¿Estas Seguro que quieres borrar ésta actividad?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id_actividad',
            'codigo_caso',
            [
                'label' => 'Analista',
                'value' => $model->analistaid ? $model->analistaid->nombre.' '.$model->analistaid->apellido : '-no info-',
            ],
            [
                'label' => 'Subproceso',
                'value' => $model->subprocesoid->nombre,
            ],
            [
                'label' => 'Usuario',
                'value' => $model->usuarioinfo ? $model->usuarioinfo->nombre.' '.$model->usuarioinfo->apellido : '-no info-',
            ],
            [
                'label' => 'Solicitud Via',
                'value' => $model->viaid->nombre,
            ],
            [
                'label' => 'Base de Datos/Aplicación',
                'value' => $model->aplicdbid->nombre,
            ],
            [
                'label' => 'Organizacion',
                'value' => $model->organizacionid->nombre,
            ],
            [
                'label' => 'Empresa',
                'value' => $model->empresaid->nombre,
            ],
            [
                'label' => 'Proyecto',
                'value' => $model->proyectoid->nombre,
            ],
            [
                'label' => 'Dato Cargado',
                'value' => $model->datocargadoid->nombre,
            ],
            [
                'label' => 'Actividad Macro',
                'value' => $model->macroid ? $model->macroid->nombre : '-no info-',
            ],
            [
                'label' => 'Actividad Detallada',
                'value' => $model->detalladaid ? $model->detalladaid->nombre : '-no info-',
            ],
            'fecha_requerimiento',
            'hora_requerimiento',
            'fecha_atencion',
            'hora_ini',
            'hora_fin',
            'HH',
            [
                'label' => 'Estado',
                'value' => $model->statusid->nombre,
            ],
            'detalle:ntext',
        ],
    ]) ?>


</div>
