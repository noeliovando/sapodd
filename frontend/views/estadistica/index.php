<?php

use yii\helpers\Html;
use yii\grid\GridView;
use miloschuman\highcharts\Highcharts;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\search\EstadisticaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Estadisticas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="estadistica-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?php
    if(date('d')>=25&&date('d')<=31)
    for ($i = 1; $i <= (date('m')+1); $i++) {
        $categorias[] = $i;
    }
    else
    for ($i = 1; $i <= date('m')+0; $i++) {
        $categorias[] = $i;
    }


    /*********************************************Grafica*************************************/
    $trabajadoresId = $searchModel->getTrabajoresId();
    $trabajadoresNombre = $searchModel->getTrabajoresNombres();

    foreach ($trabajadoresId as $trabajadores) {
        $cantidadCursos[] = $searchModel->getCantidadCursos($trabajadores);

    }

    $i = 0;
    foreach ($trabajadoresNombre as $trabajadores) {
        $series[] = [
            'name' => $trabajadores,
            'data' => $cantidadCursos[$i++],
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
    //echo '<pre>'; print_r($cantidadCursos); echo '</pre>';

    foreach ($trabajadoresId as $trabajadores) {
        $cantidadCursos2[] = $searchModel->getCantidadHH($trabajadores);

    }

    $i = 0;
    foreach ($trabajadoresNombre as $trabajadores) {
        $series2[] = [
            'name' => $trabajadores,
            'data' => $cantidadCursos2[$i++],
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
                        'format'=> '<b>{point.y:.2f}</b>',
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

 ?>

</div>
