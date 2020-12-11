<?php

use yii\helpers\Html;
use yii\grid\GridView;
use miloschuman\highcharts\Highcharts;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\search\EstadisticaAnalistaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Estadisticas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

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
    $trabajadoresId = $searchModel->getTrabajoresId();
    $trabajadoresNombre = $searchModel->getTrabajoresNombres();

    foreach ($trabajadoresId as $trabajadores) {
        $cantidadServicios[] = $searchModel->getCantidadServicios($trabajadores);

    }

    $i = 0;
    foreach ($trabajadoresNombre as $trabajadores) {
        $series[] = [
            'name' => $trabajadores,
            'data' => $cantidadServicios[$i++],
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
            'colors'=> [
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
            ],
            'title' => [
                'text' => 'Actividades por analista (Cantidad de Requerimientos)',
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
    echo '<div><h3>Requerimientos atendidos por Trabajador (Número de Servicios)</h3></div>';
    echo GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                //['class' => 'yii\grid\SerialColumn'],
                [
                    'attribute'=>'id_analista',
                    'label'=>'Trabajador',
                    'filter'=>$searchModel->getTrabajadores(),
                    'value'=>'username',
                ],
                [
                    'label' => 'Enero', 'format' => 'html',
                    'value' => function($data){
                        return $data::getNumeroServiciosTrabajador($data->id,"01");
                    }
                ],
                [
                    'label' => 'Enero', 'format' => 'html',
                    'value' => function($data){
                        return $data::getNumeroServiciosTrabajador($data->id,"01");
                    }
                ],
                [
                    'label' => 'Febrero', 'format' => 'html',
                    'value' => function($data){
                        return $data::getNumeroServiciosTrabajador($data->id,"02");
                    }
                ],
                [
                    'label' => 'Marzo', 'format' => 'html',
                    'value' => function($data){
                        return $data::getNumeroServiciosTrabajador($data->id,"03");
                    }
                ],
                [
                    'label' => 'Abril', 'format' => 'html',
                    'value' => function($data){
                        return $data::getNumeroServiciosTrabajador($data->id,"04");
                    }
                ],
                [
                    'label' => 'Mayo', 'format' => 'html',
                    'value' => function($data){
                        return $data::getNumeroServiciosTrabajador($data->id,"05");
                    }
                ],
                [
                    'label' => 'Junio', 'format' => 'html',
                    'value' => function($data){
                        return $data::getNumeroServiciosTrabajador($data->id,"06");
                    }
                ],
                [
                    'label' => 'Julio', 'format' => 'html',
                    'value' => function($data){
                        return $data::getNumeroServiciosTrabajador($data->id,"07");
                    }
                ],
                [
                    'label' => 'Agosto', 'format' => 'html',
                    'value' => function($data){
                        return $data::getNumeroServiciosTrabajador($data->id,"08");
                    }
                ],
                [
                    'label' => 'Septiembre', 'format' => 'html',
                    'value' => function($data){
                        return $data::getNumeroServiciosTrabajador($data->id,"09");
                    }
                ],
                [
                    'label' => 'Octubre', 'format' => 'html',
                    'value' => function($data){
                        return $data::getNumeroServiciosTrabajador($data->id,"10");
                    }
                ],
                [
                    'label' => 'Noviembre', 'format' => 'html',
                    'value' => function($data){
                        return $data::getNumeroServiciosTrabajador($data->id,"11");
                    }
                ],
                [
                    'label' => 'Diciembre', 'format' => 'html',
                    'value' => function($data){
                        return $data::getNumeroServiciosTrabajador($data->id,"12");
                    }
                ],
            ],
        ]
    );
    foreach ($trabajadoresId as $trabajadores) {
        $cantidadServiciosHH[] = $searchModel->getCantidadServiciosHH($trabajadores);

    }

    $i = 0;
    foreach ($trabajadoresNombre as $trabajadores) {
        $series2[] = [
            'name' => $trabajadores,
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
            'colors'=> [
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
            ],
            'title' => [
                'text' => 'Actividades por analista (hora)',
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
    echo '<div><h3>Requerimientos atendidos por Trabajador (Horas)</h3></div>';
    echo GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                //['class' => 'yii\grid\SerialColumn'],
                [
                    'attribute'=>'id_analista',
                    'label'=>'Trabajador',
                    'filter'=>$searchModel->getTrabajadores(),
                    'value'=>'username',
                ],
                [
                    'label' => 'Enero', 'format' => 'html',
                    'value' => function($data){
                        return $data::getNumeroServiciosTrabajadorHH($data->id,"01");
                    }
                ],
                [
                    'label' => 'Enero', 'format' => 'html',
                    'value' => function($data){
                        return $data::getNumeroServiciosTrabajadorHH($data->id,"01");
                    }
                ],
                [
                    'label' => 'Febrero', 'format' => 'html',
                    'value' => function($data){
                        return $data::getNumeroServiciosTrabajadorHH($data->id,"02");
                    }
                ],
                [
                    'label' => 'Marzo', 'format' => 'html',
                    'value' => function($data){
                        return $data::getNumeroServiciosTrabajadorHH($data->id,"03");
                    }
                ],
                [
                    'label' => 'Abril', 'format' => 'html',
                    'value' => function($data){
                        return $data::getNumeroServiciosTrabajadorHH($data->id,"04");
                    }
                ],
                [
                    'label' => 'Mayo', 'format' => 'html',
                    'value' => function($data){
                        return $data::getNumeroServiciosTrabajadorHH($data->id,"05");
                    }
                ],
                [
                    'label' => 'Junio', 'format' => 'html',
                    'value' => function($data){
                        return $data::getNumeroServiciosTrabajadorHH($data->id,"06");
                    }
                ],
                [
                    'label' => 'Julio', 'format' => 'html',
                    'value' => function($data){
                        return $data::getNumeroServiciosTrabajadorHH($data->id,"07");
                    }
                ],
                [
                    'label' => 'Agosto', 'format' => 'html',
                    'value' => function($data){
                        return $data::getNumeroServiciosTrabajadorHH($data->id,"08");
                    }
                ],
                [
                    'label' => 'Septiembre', 'format' => 'html',
                    'value' => function($data){
                        return $data::getNumeroServiciosTrabajadorHH($data->id,"09");
                    }
                ],
                [
                    'label' => 'Octubre', 'format' => 'html',
                    'value' => function($data){
                        return $data::getNumeroServiciosTrabajadorHH($data->id,"10");
                    }
                ],
                [
                    'label' => 'Noviembre', 'format' => 'html',
                    'value' => function($data){
                        return $data::getNumeroServiciosTrabajadorHH($data->id,"11");
                    }
                ],
                [
                    'label' => 'Diciembre', 'format' => 'html',
                    'value' => function($data){
                        return $data::getNumeroServiciosTrabajadorHH($data->id,"12");
                    }
                ],
            ],
        ]
    );
    ?>

</div>
