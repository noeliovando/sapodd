<?php

use yii\helpers\Html;
use yii\helpers\StringHelper;
use yii\widgets\ActiveForm;
use yii\grid\GridView;
use yii\data\ArrayDataProvider;
use miloschuman\highcharts\Highcharts;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\search\ReporteSearch */
/* @var $dataProvider yii\data\ArrayDataProvider */
/* @var $model frontend\models\Reporte */

$this->title = 'Reporte';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reporte-index">

    <h2><?= Html::encode($this->title) ?></h2>
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
    $organizacionesId = $searchModel->getOrganizacionesId();
    $organizacionesNombre = $searchModel->getOrganizacionesNombres();

    foreach ($organizacionesId as $organizacion) {
        $cantidadServicios[] = $searchModel->getCantidadServicios($organizacion);

    }
    $i = 0;
    $totalmes=0;
    foreach ($organizacionesId as $organizacion) {
        $servicios= $cantidadServicios[$i++];
        $totalmes = $totalmes + $servicios[date('d')>25?(date('m'))-2:(date('m'))-1];
    }

    $i = 0;
    foreach ($organizacionesNombre as $organizacion) {
        $servicios= $cantidadServicios[$i++];
        $data[] = [$organizacion,$totalmes==0?0:$servicios[date('d')>25?(date('m'))-2:(date('m'))-1]*100/$totalmes];
    }

    //echo '<pre>'; print_r($data); echo '</pre>';

    /***********************OLD***************************/



    //echo '<pre>'; print_r($data); echo '</pre>';
    $resultDataEmpresas = [
        '1' => [
            'empresa'          => 'PETRO MACAREO',
            'enero'         => $searchModel->getNroPM('01'),
            'febrero'         => $searchModel->getNroPM('02'),
            'marzo'         => $searchModel->getNroPM('03'),
            'abril'         => $searchModel->getNroPM('04'),
            'mayo'         => $searchModel->getNroPM('05'),
            'junio'         => $searchModel->getNroPM('06'),
            'julio'         => $searchModel->getNroPM('07'),
            'agosto'         => $searchModel->getNroPM('08'),
            'septiembre'         => $searchModel->getNroPM('09'),
            'octubre'         => $searchModel->getNroPM('10'),
            'noviembre'         => $searchModel->getNroPM('11'),
            'diciembre'         => $searchModel->getNroPM('12'),
        ],
        '2' => [
            'empresa'          => 'INDOVENEZOLANA',
            'enero'         => $searchModel->getNroINDO('01'),
            'febrero'         => $searchModel->getNroINDO('02'),
            'marzo'         => $searchModel->getNroINDO('03'),
            'abril'         => $searchModel->getNroINDO('04'),
            'mayo'         => $searchModel->getNroINDO('05'),
            'junio'         => $searchModel->getNroINDO('06'),
            'julio'         => $searchModel->getNroINDO('07'),
            'agosto'         => $searchModel->getNroINDO('08'),
            'septiembre'         => $searchModel->getNroINDO('09'),
            'octubre'         => $searchModel->getNroINDO('10'),
            'noviembre'         => $searchModel->getNroINDO('11'),
            'diciembre'         => $searchModel->getNroINDO('12'),
        ],
        '3' => [
            'empresa'          => 'PETRO MIRANDA',
            'enero'         => $searchModel->getNroPMI('01'),
            'febrero'         => $searchModel->getNroPMI('02'),
            'marzo'         => $searchModel->getNroPMI('03'),
            'abril'         => $searchModel->getNroPMI('04'),
            'mayo'         => $searchModel->getNroPMI('05'),
            'junio'         => $searchModel->getNroPMI('06'),
            'julio'         => $searchModel->getNroPMI('07'),
            'agosto'         => $searchModel->getNroPMI('08'),
            'septiembre'         => $searchModel->getNroPMI('09'),
            'octubre'         => $searchModel->getNroPMI('10'),
            'noviembre'         => $searchModel->getNroPMI('11'),
            'diciembre'         => $searchModel->getNroPMI('12'),
        ],
        '4' => [
            'empresa'          => 'PETRO CEDEÑO',
            'enero'         => $searchModel->getNroPC('01'),
            'febrero'         => $searchModel->getNroPC('02'),
            'marzo'         => $searchModel->getNroPC('03'),
            'abril'         => $searchModel->getNroPC('04'),
            'mayo'         => $searchModel->getNroPC('05'),
            'junio'         => $searchModel->getNroPC('06'),
            'julio'         => $searchModel->getNroPC('07'),
            'agosto'         => $searchModel->getNroPC('08'),
            'septiembre'         => $searchModel->getNroPC('09'),
            'octubre'         => $searchModel->getNroPC('10'),
            'noviembre'         => $searchModel->getNroPC('11'),
            'diciembre'         => $searchModel->getNroPC('12'),
        ],
        '5' => [
            'empresa'          => 'PETRO URICA',
            'enero'         => $searchModel->getNroPU('01'),
            'febrero'         => $searchModel->getNroPU('02'),
            'marzo'         => $searchModel->getNroPU('03'),
            'abril'         => $searchModel->getNroPU('04'),
            'mayo'         => $searchModel->getNroPU('05'),
            'junio'         => $searchModel->getNroPU('06'),
            'julio'         => $searchModel->getNroPU('07'),
            'agosto'         => $searchModel->getNroPU('08'),
            'septiembre'         => $searchModel->getNroPU('09'),
            'octubre'         => $searchModel->getNroPU('10'),
            'noviembre'         => $searchModel->getNroPU('11'),
            'diciembre'         => $searchModel->getNroPU('12'),
        ],
        '6' => [
            'empresa'          => 'PETRO JUNIN',
            'enero'         => $searchModel->getNroPJ('01'),
            'febrero'         => $searchModel->getNroPJ('02'),
            'marzo'         => $searchModel->getNroPJ('03'),
            'abril'         => $searchModel->getNroPJ('04'),
            'mayo'         => $searchModel->getNroPJ('05'),
            'junio'         => $searchModel->getNroPJ('06'),
            'julio'         => $searchModel->getNroPJ('07'),
            'agosto'         => $searchModel->getNroPJ('08'),
            'septiembre'         => $searchModel->getNroPJ('09'),
            'octubre'         => $searchModel->getNroPJ('10'),
            'noviembre'         => $searchModel->getNroPJ('11'),
            'diciembre'         => $searchModel->getNroPJ('12'),
        ],
        '7' => [
            'empresa'          => 'PETRO SAN FELIX',
            'enero'         => $searchModel->getNroPSF('01'),
            'febrero'         => $searchModel->getNroPSF('02'),
            'marzo'         => $searchModel->getNroPSF('03'),
            'abril'         => $searchModel->getNroPSF('04'),
            'mayo'         => $searchModel->getNroPSF('05'),
            'junio'         => $searchModel->getNroPSF('06'),
            'julio'         => $searchModel->getNroPSF('07'),
            'agosto'         => $searchModel->getNroPSF('08'),
            'septiembre'         => $searchModel->getNroPSF('09'),
            'octubre'         => $searchModel->getNroPSF('10'),
            'noviembre'         => $searchModel->getNroPSF('11'),
            'diciembre'         => $searchModel->getNroPSF('12'),
        ],
    ];


    $empresas =['Petro San Feliz','Petro Junin','Petro Cedeño','Petro Macareo','Petro Miranda','Petro Urica','Indovenezolana'];
    $psf=['','','','','','','','','','','',''];
    $pj=['','','','','','','','','','','',''];
    $pc=['','','','','','','','','','','',''];
    $pma=['','','','','','','','','','','',''];
    $pmi=['','','','','','','','','','','',''];
    $pu=['','','','','','','','','','','',''];
    $indo=['','','','','','','','','','','',''];
    for($i=0;$i<12;$i++)
    {
        $psf[$i]=$searchModel->getNroPSF($i+1)+0;
        $pj[$i]=$searchModel->getNroPJ($i+1)+0;
        $pc[$i]=$searchModel->getNroPC($i+1)+0;
        $pma[$i]=$searchModel->getNroPM($i+1)+0;
        $pmi[$i]=$searchModel->getNroPMI($i+1)+0;
        $pu[$i]=$searchModel->getNroPU($i+1)+0;
        $indo[$i]=$searchModel->getNroINDO($i+1)+0;
    }
    $totalmes=$searchModel->getNumeroEEII(date('m'))+
        $searchModel->getNumeroDY(date('m'))+0+
        $searchModel->getNumeroOP(date('m'))+0+
        $searchModel->getNumeroCMP(date('m'))+0+
        $searchModel->getNumeroOOGG(date('m')+0);
    $meses=[
        '1'=>'Enero',
        '2'=>'Febrero',
        '3'=>'Marzo',
        '4'=>'Abril',
        '5'=>'Mayo',
        '6'=>'Junio',
        '7'=>'Julio',
        '8'=>'Agosto',
        '9'=>'Septiembre',
        '10'=>'Octubre',
        '11'=>'Noviembre',
        '12'=>'Diciembre',
    ];

    '<div class="col-lg-3">';
    echo Highcharts::widget([
        'options' => [
            'chart' => [
                //'width' => 500,
                //'height' => 400,
            ],

            'title' => ['text' => 'Organizaciones Atendidas en '.$meses[(date('d')>25? Yii::$app->formatter->asDate(date('Y').'-'.(date('m')+1).'-'.date('d'),'php:n'):date('n'))]],
            'credits' => ['enabled' => false],
            'plotOptions' => [
                'pie' => [
                    'allowPointSelect'=> true,
                    'cursor'=>'pointer',
                    'tooltip'=>[
                        'pointFormat'=>'<b>{point.percentage:.1f}%</b>',
                    ],
                    'dataLabels'=> [
                        'enabled'=> false,
                    ],
                    'showInLegend'=> true,
                ],
            ],
            'series' => [
                [ // new opening bracket
                    'type' => 'pie',
                    'name' => 'Porcentaje',
                    'data' => $data,
                ] // new closing bracket
            ],
        ],
    ]);
    '</div>';
    $i = 0;
    foreach ($organizacionesNombre as $organizaciones) {
        $seriesColumn[] = [
            'name' => $organizaciones,
            'data' => $cantidadServicios[$i++],
            'type' => 'column',
            'dataLabels' => [
                'enabled' => true,
            ],
        ];
    }
    '<div class="col-lg-3">';
    echo Highcharts::widget([
        'options' => [
            'chart' => [
                //'width' => 500,
                //'height' => 400,
            ],
            'title' => ['text' => 'Organizaciones atendidas en '.date('Y')],
            'credits' => ['enabled' => false],

            'xAxis' => [
                'categories' => ['enero','febrero','marzo','abril','mayo','junio','julio','agosto','septiembre','octubre','noviembre','diciembre']
            ],
            'yAxis' => [
                'title' => ['text' => 'Servicios']
            ],
            'series' => $seriesColumn,

        ]
    ]);
    '</div>';
    $i = 0;
    foreach ($organizacionesNombre as $organizaciones) {
        $seriesLine[] = [
            'name' => $organizaciones,
            'data' => $cantidadServicios[$i++],
            'type' => 'line',
            'dataLabels' => [
                'enabled' => true,
            ],
        ];
    }
    echo Highcharts::widget([
        'options' => [
            'title' => ['text' => 'Organizaciones atendidas en '.date('Y')],
            'credits' => ['enabled' => false],

            'xAxis' => [
                'categories' => ['enero','febrero','marzo','abril','mayo','junio','julio','agosto','septiembre','octubre','noviembre','diciembre']
            ],
            'yAxis' => [
                'title' => ['text' => 'Servicios']
            ],
            'series' => $seriesLine,

        ]
    ]);

    echo '<div><h3>Requerimientos por Organización por número de Requerimiento</h3></div>';
    echo GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                /*['class' => 'yii\grid\SerialColumn'],*/
                [
                    'attribute'=>'id_organizacion',
                    'label'=>'Organizacion',
                    'filter'=>$searchModel->getOrganizacion(),
                    'value'=>'organizacionNombre',
                ],
                [
                    'label' => 'Enero', 'format' => 'html',
                    'value' => function($data){
                        return $data::getNumeroOrganizacion($data->id_organizacion,"01");
                    }
                ],
                [
                    'label' => 'Febrero', 'format' => 'html',
                    'value' => function($data){
                        return $data::getNumeroOrganizacion($data->id_organizacion,"02");
                    }
                ],
                [
                    'label' => 'Marzo', 'format' => 'html',
                    'value' => function($data){
                        return $data::getNumeroOrganizacion($data->id_organizacion,"03");
                    }
                ],
                [
                    'label' => 'Abril', 'format' => 'html',
                    'value' => function($data){
                        return $data::getNumeroOrganizacion($data->id_organizacion,"04");
                    }
                ],
                [
                    'label' => 'Mayo', 'format' => 'html',
                    'value' => function($data){
                        return $data::getNumeroOrganizacion($data->id_organizacion,"05");
                    }
                ],
                [
                    'label' => 'Junio', 'format' => 'html',
                    'value' => function($data){
                        return $data::getNumeroOrganizacion($data->id_organizacion,"06");
                    }
                ],
                [
                    'label' => 'Julio', 'format' => 'html',
                    'value' => function($data){
                        return $data::getNumeroOrganizacion($data->id_organizacion,"07");
                    }
                ],
                [
                    'label' => 'Agosto', 'format' => 'html',
                    'value' => function($data){
                        return $data::getNumeroOrganizacion($data->id_organizacion,"08");
                    }
                ],
                [
                    'label' => 'Septiembre', 'format' => 'html',
                    'value' => function($data){
                        return $data::getNumeroOrganizacion($data->id_organizacion,"09");
                    }
                ],
                [
                    'label' => 'Octubre', 'format' => 'html',
                    'value' => function($data){
                        return $data::getNumeroOrganizacion($data->id_organizacion,"10");
                    }
                ],
                [
                    'label' => 'Noviembre', 'format' => 'html',
                    'value' => function($data){
                        return $data::getNumeroOrganizacion($data->id_organizacion,"11");
                    }
                ],
                [
                    'label' => 'Diciembre', 'format' => 'html',
                    'value' => function($data){
                        return $data::getNumeroOrganizacion($data->id_organizacion,"12");
                    }
                ],
            ],
        ]
    );


    echo '<div><h3>Requerimientos por Organización por horas hombre</h3></div>';
    echo GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                /*['class' => 'yii\grid\SerialColumn'],*/
                [
                    'attribute'=>'id_organizacion',
                    'label'=>'Organizacion',
                    'filter'=>$searchModel->getOrganizacion(),
                    'value'=>'organizacionNombre',
                ],
                [
                    'label' => 'Enero', 'format' => 'html',
                    'value' => function($data){
                        return $data::getHorasOrganizacion($data->id_organizacion,"01");
                    }
                ],
                [
                    'label' => 'Febrero', 'format' => 'html',
                    'value' => function($data){
                        return $data::getHorasOrganizacion($data->id_organizacion,"02");
                    }
                ],
                [
                    'label' => 'Marzo', 'format' => 'html',
                    'value' => function($data){
                        return $data::getHorasOrganizacion($data->id_organizacion,"03");
                    }
                ],
                [
                    'label' => 'Abril', 'format' => 'html',
                    'value' => function($data){
                        return $data::getHorasOrganizacion($data->id_organizacion,"04");
                    }
                ],
                [
                    'label' => 'Mayo', 'format' => 'html',
                    'value' => function($data){
                        return $data::getHorasOrganizacion($data->id_organizacion,"05");
                    }
                ],
                [
                    'label' => 'Junio', 'format' => 'html',
                    'value' => function($data){
                        return $data::getHorasOrganizacion($data->id_organizacion,"06");
                    }
                ],
                [
                    'label' => 'Julio', 'format' => 'html',
                    'value' => function($data){
                        return $data::getHorasOrganizacion($data->id_organizacion,"07");
                    }
                ],
                [
                    'label' => 'Agosto', 'format' => 'html',
                    'value' => function($data){
                        return $data::getHorasOrganizacion($data->id_organizacion,"08");
                    }
                ],
                [
                    'label' => 'Septiembre', 'format' => 'html',
                    'value' => function($data){
                        return $data::getHorasOrganizacion($data->id_organizacion,"09");
                    }
                ],
                [
                    'label' => 'Octubre', 'format' => 'html',
                    'value' => function($data){
                        return $data::getHorasOrganizacion($data->id_organizacion,"10");
                    }
                ],
                [
                    'label' => 'Noviembre', 'format' => 'html',
                    'value' => function($data){
                        return $data::getHorasOrganizacion($data->id_organizacion,"11");
                    }
                ],
                [
                    'label' => 'Diciembre', 'format' => 'html',
                    'value' => function($data){
                        return $data::getHorasOrganizacion($data->id_organizacion,"12");
                    }
                ],
            ],
        ]
    );


    echo Highcharts::widget([
        'options' => [
            'title' => ['text' => 'Organizaciones atendidas en '.date('Y')],
            'credits' => ['enabled' => false],

            'xAxis' => [
                'categories' => ['enero','febrero','marzo','abril','mayo','junio','julio','agosto','septiembre','octubre','noviembre','diciembre']
            ],
            'yAxis' => [
                'title' => ['text' => 'Servicios']
            ],
            'series' => [
                ['name' => 'Petro San Felix', 'data' => $psf,'type'=> 'column',],
                ['name' => 'Petro Junin', 'data' => $pj,'type'=> 'column',],
                ['name' => 'Petro Cedeño', 'data' => $pc,'type'=> 'column',],
                ['name' => 'Petro Macareo', 'data' => $pma,'type'=> 'column',],
                ['name' => 'Petro Miranda', 'data' => $pmi,'type'=> 'column',],
                ['name' => 'Petro Urica', 'data' => $pu,'type'=> 'column',],
                ['name' => 'Indovenezolana', 'data' => $indo,'type'=> 'column',],


            ],

        ]
    ]);
    echo Highcharts::widget([
        'options' => [
            'title' => ['text' => 'Organizaciones atendidas en '.date('Y')],
            'credits' => ['enabled' => false],

            'xAxis' => [
                'categories' => ['enero','febrero','marzo','abril','mayo','junio','julio','agosto','septiembre','octubre','noviembre','diciembre']
            ],
            'yAxis' => [
                'title' => ['text' => 'Requerimientos']
            ],
            'series' => [

                ['name' => 'Petro San Felix', 'data' => $psf,'type'=> 'line',],
                ['name' => 'Petro Junin', 'data' => $pj,'type'=> 'line',],
                ['name' => 'Petro Cedeño', 'data' => $pc,'type'=> 'line',],
                ['name' => 'Petro Macareo', 'data' => $pma,'type'=> 'line',],
                ['name' => 'Petro Miranda', 'data' => $pmi,'type'=> 'line',],
                ['name' => 'Petro Urica', 'data' => $pu,'type'=> 'line',],
                ['name' => 'Indovenezolana', 'data' => $indo,'type'=> 'line',],

            ],

        ]
    ]);

    $dataProviderEmpresas = new ArrayDataProvider([
        'allModels' => $resultDataEmpresas,
        'sort' => [
            'attributes' => ['empresa', 'enero','febrero','marzo','abril','mayo','junio','julio','agosto','septiembre','octubre','noviembre','diciembre']
        ],
        'pagination' => [
            'pageSize' => 10,
        ],
    ]);
    echo '<div><h3>Empresa Mixta Atendidas</h3></div>';
    echo GridView::widget([
            'dataProvider' => $dataProviderEmpresas,
            //'filterModel' => $searchModel,
            'columns' => ['empresa', 'enero','febrero','marzo','abril','mayo','junio','julio','agosto','septiembre','octubre','noviembre','diciembre']
        ]
    );
    //echo '<pre>'; print_r($resultDataOrganizacion); echo '</pre>';
    ?>
