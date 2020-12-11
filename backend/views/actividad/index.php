<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\search\ActividadSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Actividads';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="actividad-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Actividad', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_actividad',
            'codigo_caso',
            'id_analista',
            'id_subproceso',
            'id_usuario',
            // 'id_via',
            // 'id_bd',
            // 'id_organizacion',
            // 'id_distrito',
            // 'id_empresa',
            // 'id_proyecto',
            // 'id_proy_ep',
            // 'id_dato_cargado',
            // 'ndlis',
            // 'nlis',
            // 'nlas',
            // 'ntiff',
            // 'npdf',
            // 'npds',
            // 'id_anio_pozo',
            // 'id_macro',
            // 'id_detallada',
            // 'fecha_requerimiento',
            // 'hora_requerimiento',
            // 'fecha_ini_aten',
            // 'hora_ini',
            // 'fecha_fin_aten',
            // 'hora_fin',
            // 'HH',
            // 'id_status',
            // 'detalle:ntext',
            // 'pozo',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
