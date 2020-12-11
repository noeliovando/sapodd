<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\export\ExportMenu;



/* @var $this yii\web\View */
/* @var $searchModel frontend\models\search\ActividadSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Actividades';
$this->params['breadcrumbs'][] = $this->title;
$botones ='{view} {update} {delete} {clonar} ';
?>
<div class="actividad-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Crear Actividad', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php
    $gridColumns = [
        //'id_actividad',
        'codigo_caso',
        [
            'label' => 'Organizacion',
            'attribute' => 'organizacionNombre',
        ],
        [
            'label'=>'Analista',
            'value'=>'analistaUsername',
        ],
        // 'id_via',
        [
            'label'=>'Aplicacion/BD',
            'value'=>'aplicacionNombre',
        ],
        [
            'label'=>'Empresa',
            'value'=>'empresaNombre',
        ],
        [
            'label'=>'Actividad Macro',
            'value'=>'macroNombre',
        ],
        [
            'label'=>'Actividad Detallada',
            'value'=>'detalladaNombre',
        ],
        //'fecha_requerimiento',
        // 'hora_requerimiento',
        [
            'attribute'=>'fecha_atencion',
            'format' => ['date', 'php:d/m/Y'],
        ],
        'hora_ini',
        // 'fecha_fin_aten',
        'hora_fin',
        [
            'attribute'=>'HH',
            'format' => ['decimal',2]
        ],
        // 'id_status',
        'detalle:ntext',
        // 'pozo',
    ];
    echo ExportMenu::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => $gridColumns,
        'fontAwesome' => true,
    ]);
    ?>
    <?php
    if(Yii::$app->user->identity->rol_id=='3')
        $botones ='{view} {update} {delete} {clonar} ';
    else
        $botones ='{view} ';
    ?>
    <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            //'layout'=>"{items}",
            'options' => ['style' => 'font-size:10px;'],
            'columns' => [
                //['class' => 'yii\grid\SerialColumn'],

                //'id_actividad',
                //'codigo_caso',
                [
                    'attribute'=>'id_analista',
                    'filter'=>$searchModel->getAnalista(),
                    'label'=>'Analista',
                    'value'=>'analistaUsername',
                ],
                // 'id_via',
                [
                    'attribute'=>'id_bd',
                    'filter'=>$searchModel->getAplicacion(),
                    'label'=>'Aplicacion/BD',
                    'value'=>'aplicacionNombre',
                ],
                /*[
                    'attribute'=>'id_distrito',
                    'filter'=>$searchModel->getDistrito(),
                    'label'=>'Distrito',
                    'value'=>'distritoNombre',
                ],*/
                [
                    'attribute'=>'id_organizacion',
                    'filter'=>$searchModel->getOrganizacion(),
                    'label'=>'Organización',
                    'value'=>'organizacionNombre',
                ],
                [
                    'attribute' => 'fecha_atencion',
                    'filter' => $searchModel->getMonthList(),
                ],
                /*[
                    'attribute'=>'id_empresa',
                    'filter'=>$searchModel->getEmpresa(),
                    'label'=>'Empresa',
                    'value'=>'empresaNombre',
                ],*/
                /*
                [
                    'attribute'=>'id_proy_ep',
                    'filter'=>$searchModel->getProyectoEp(),
                    'label'=>'Proyecto EP',
                    'value'=>'proyectoEpNombre',
                ],*/
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
                /*[
                    'attribute'=>'id_macro',
                    'filter'=>$searchModel->getActividadMacro(),
                    'label'=>'Actividad Macro',
                    'value'=>'macroNombre',
                ],*/
                [
                    'attribute'=>'id_detallada',
                    'filter'=>$searchModel->getActividadDetallada(),
                    'label'=>'Actividad Detallada',
                    'value'=>'detalladaNombre',
                ],
                //'fecha_requerimiento',
                // 'hora_requerimiento',
                [
                    'attribute'=>'fecha_atencion',
                    'format' => ['date', 'php:d/m/Y'],
                ],
                'hora_ini',
                // 'fecha_fin_aten',
                'hora_fin',
                [
                    'attribute'=>'HH',
                    'format' => ['decimal',2]
                ],
                // 'id_status',
                [
                    'attribute'=>'detalle',
                    'value'=>'detalle',
                    'contentOptions'=>['style'=>'min-width: 300px;']
                ],
                // 'pozo',

                ['class' => 'yii\grid\ActionColumn',
                    'template' => $botones,
                    'buttons' => [
                        'clonar' => function ($url, $model) {
                            return Html::a('<span class="glyphicon glyphicon-download"></span>', $url, [
                                'title' => Yii::t('app', 'Clonar'),
                            ]);
                        },

                    ],

                ],
            ],
        ]
    ); ?>

</div>
