<?php

use yii\helpers\Html;
use yii\grid\GridView;
use miloschuman\highcharts\Highcharts;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\search\OrganizacionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Organizaciones';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="organizacion-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


    <?php
    $mes = ['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'];
    if(date('d')>=25&&date('d')<=31)
        for ($i = 1; $i <= (date('m')+1); $i++) {
            $categorias[] = $mes[$i];
        }
    else
        for ($i = 1; $i <= date('m')+0; $i++) {
            $categorias[] = $mes[$i-1];
        }


    /*********************************************Grafica*************************************/
    $organizacionesId = $searchModel->getOrganizacionesId();
    $organizacionesNombre = $searchModel->getOrganizacionesNombres();

    foreach ($organizacionesId as $organizaciones) {
        $cantidadServicios[] = $searchModel->getCantidadServicios($organizaciones);

    }

    $i = 0;
    foreach ($organizacionesNombre as $organizaciones) {
        $series[] = [
            'name' => $organizaciones,
            'data' => $cantidadServicios[$i++],
            'type' => 'column',
            'dataLabels' => [
                'enabled' => true,
            ],
        ];
    }
    //echo '<pre>'; print_r($organizacionesNombre); echo '</pre>';
    echo Highcharts::widget([
        'options' => [
            'chart' => [
                //'type'=>'column',
            ],
            /*'colors'=> [
                'red',
                'navy',
                'blueViolet ',
                'brown',
                'slategrey',
                'green',
                'coral',
                'goldenrod',
                'deeppink ',
                'lightgreen',
                'aqua',
                'blue'
            ],*/
            'title' => [
                'text' => 'Actividades por organizacion (Cantidad de Servicios)',
            ],
            'credits' => ['enabled' => false],

            'xAxis' => [
                'categories' => $categorias,
            ],
            'yAxis' => [
                'title' => ['text' => 'Servicios']
            ],
            'series' =>
                $series,

        ]
    ]);
    echo '<div><h3>Requerimientos atendidos por Organizacion (Número de Servicios)</h3></div>';
    echo GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                //['class' => 'yii\grid\SerialColumn'],
                [
                    'attribute'=>'id_analista',
                    'label'=>'Trabajador',
                    'filter'=>$searchModel->getOrganizaciones(),
                    'value'=>'nombre',
                ],
                [
                    'label' => 'Enero', 'format' => 'html',
                    'value' => function($data){
                        return $data::getNumeroServiciosOrganizacion($data->id,"01");
                    }
                ],
                [
                    'label' => 'Enero', 'format' => 'html',
                    'value' => function($data){
                        return $data::getNumeroServiciosOrganizacion($data->id,"01");
                    }
                ],
                [
                    'label' => 'Febrero', 'format' => 'html',
                    'value' => function($data){
                        return $data::getNumeroServiciosOrganizacion($data->id,"02");
                    }
                ],
                [
                    'label' => 'Marzo', 'format' => 'html',
                    'value' => function($data){
                        return $data::getNumeroServiciosOrganizacion($data->id,"03");
                    }
                ],
                [
                    'label' => 'Abril', 'format' => 'html',
                    'value' => function($data){
                        return $data::getNumeroServiciosOrganizacion($data->id,"04");
                    }
                ],
                [
                    'label' => 'Mayo', 'format' => 'html',
                    'value' => function($data){
                        return $data::getNumeroServiciosOrganizacion($data->id,"05");
                    }
                ],
                [
                    'label' => 'Junio', 'format' => 'html',
                    'value' => function($data){
                        return $data::getNumeroServiciosOrganizacion($data->id,"06");
                    }
                ],
                [
                    'label' => 'Julio', 'format' => 'html',
                    'value' => function($data){
                        return $data::getNumeroServiciosOrganizacion($data->id,"07");
                    }
                ],
                [
                    'label' => 'Agosto', 'format' => 'html',
                    'value' => function($data){
                        return $data::getNumeroServiciosOrganizacion($data->id,"08");
                    }
                ],
                [
                    'label' => 'Septiembre', 'format' => 'html',
                    'value' => function($data){
                        return $data::getNumeroServiciosOrganizacion($data->id,"09");
                    }
                ],
                [
                    'label' => 'Octubre', 'format' => 'html',
                    'value' => function($data){
                        return $data::getNumeroServiciosOrganizacion($data->id,"10");
                    }
                ],
                [
                    'label' => 'Noviembre', 'format' => 'html',
                    'value' => function($data){
                        return $data::getNumeroServiciosOrganizacion($data->id,"11");
                    }
                ],
                [
                    'label' => 'Diciembre', 'format' => 'html',
                    'value' => function($data){
                        return $data::getNumeroServiciosOrganizacion($data->id,"12");
                    }
                ],
            ],
        ]
    );
    foreach ($organizacionesId as $organizaciones) {
        $cantidadServiciosHH[] = $searchModel->getCantidadServiciosHH($organizaciones);

    }

    $i = 0;
    foreach ($organizacionesNombre as $organizaciones) {
        $series2[] = [
            'name' => $organizaciones,
            'data' => $cantidadServiciosHH[$i++],
            'type' => 'column',
            'dataLabels' => [
                'enabled' => true,
            ],
        ];
    }
    //echo '<pre>'; print_r($series); echo '</pre>';
    echo Highcharts::widget([
        'options' => [
            'chart' => [
                //'type'=>'column',
            ],
            /*'colors'=> [
                'red',
                'navy',
                'blueViolet ',
                'brown',
                'slategrey',
                'green',
                'coral',
                'goldenrod',
                'deeppink ',
                'lightgreen',
                'aqua',
                'blue'
            ],*/
            'title' => [
                'text' => 'Actividades por organizacion (hora)',
            ],
            'plotOptions'=>[
                'column'=>[
                    'dataLabels'=> [
                        'enabled'=> true,
                        'format'=> '<b>{point.y:.0f}</b>',
                    ]
                ]
            ],
            'credits' => ['enabled' => false],

            'xAxis' => [
                'categories' => $categorias,
            ],
            'yAxis' => [
                'title' => ['text' => 'HH']
            ],
            'series' =>
                $series2,

        ]
    ]);
    echo '<div><h3>Requerimientos atendidos por Organizacion (Horas)</h3></div>';
    echo GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                //['class' => 'yii\grid\SerialColumn'],
                [
                    'attribute'=>'id_analista',
                    'label'=>'Trabajador',
                    'filter'=>$searchModel->getOrganizaciones(),
                    'value'=>'nombre',
                ],
                [
                    'label' => 'Enero', 'format' => 'html',
                    'value' => function($data){
                        return $data::getNumeroServiciosOrganizacionHH($data->id,"01");
                    }
                ],
                [
                    'label' => 'Enero', 'format' => 'html',
                    'value' => function($data){
                        return $data::getNumeroServiciosOrganizacionHH($data->id,"01");
                    }
                ],
                [
                    'label' => 'Febrero', 'format' => 'html',
                    'value' => function($data){
                        return $data::getNumeroServiciosOrganizacionHH($data->id,"02");
                    }
                ],
                [
                    'label' => 'Marzo', 'format' => 'html',
                    'value' => function($data){
                        return $data::getNumeroServiciosOrganizacionHH($data->id,"03");
                    }
                ],
                [
                    'label' => 'Abril', 'format' => 'html',
                    'value' => function($data){
                        return $data::getNumeroServiciosOrganizacionHH($data->id,"04");
                    }
                ],
                [
                    'label' => 'Mayo', 'format' => 'html',
                    'value' => function($data){
                        return $data::getNumeroServiciosOrganizacionHH($data->id,"05");
                    }
                ],
                [
                    'label' => 'Junio', 'format' => 'html',
                    'value' => function($data){
                        return $data::getNumeroServiciosOrganizacionHH($data->id,"06");
                    }
                ],
                [
                    'label' => 'Julio', 'format' => 'html',
                    'value' => function($data){
                        return $data::getNumeroServiciosOrganizacionHH($data->id,"07");
                    }
                ],
                [
                    'label' => 'Agosto', 'format' => 'html',
                    'value' => function($data){
                        return $data::getNumeroServiciosOrganizacionHH($data->id,"08");
                    }
                ],
                [
                    'label' => 'Septiembre', 'format' => 'html',
                    'value' => function($data){
                        return $data::getNumeroServiciosOrganizacionHH($data->id,"09");
                    }
                ],
                [
                    'label' => 'Octubre', 'format' => 'html',
                    'value' => function($data){
                        return $data::getNumeroServiciosOrganizacionHH($data->id,"10");
                    }
                ],
                [
                    'label' => 'Noviembre', 'format' => 'html',
                    'value' => function($data){
                        return $data::getNumeroServiciosOrganizacionHH($data->id,"11");
                    }
                ],
                [
                    'label' => 'Diciembre', 'format' => 'html',
                    'value' => function($data){
                        return $data::getNumeroServiciosOrganizacionHH($data->id,"12");
                    }
                ],
            ],
        ]
    );
    ?>

</div>
