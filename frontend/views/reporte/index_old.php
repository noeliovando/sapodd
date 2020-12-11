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

    $resultDataOrganizacion = [
        '1' => [
            'gerencia'          => 'Estudios Integrados',
            'enero'         => $searchModel->getNumeroEEII('01'),
            'febrero'         => $searchModel->getNumeroEEII('02'),
            'marzo'         => $searchModel->getNumeroEEII('03'),
            'abril'         => $searchModel->getNumeroEEII('04'),
            'mayo'         => $searchModel->getNumeroEEII('05'),
            'junio'         => $searchModel->getNumeroEEII('06'),
            'julio'         => $searchModel->getNumeroEEII('07'),
            'agosto'         => $searchModel->getNumeroEEII('08'),
            'septiembre'         => $searchModel->getNumeroEEII('09'),
            'octubre'         => $searchModel->getNumeroEEII('10'),
            'noviembre'         => $searchModel->getNumeroEEII('11'),
            'diciembre'         => $searchModel->getNumeroEEII('12'),


        ],
        '2' => [
            'gerencia'          => 'Desarrollo de Yacimientos',
            'enero'         => $searchModel->getNumeroDY('01'),
            'febrero'         => $searchModel->getNumeroDY('02'),
            'marzo'         => $searchModel->getNumeroDY('03'),
            'abril'         => $searchModel->getNumeroDY('04'),
            'mayo'         => $searchModel->getNumeroDY('05'),
            'junio'         => $searchModel->getNumeroDY('06'),
            'julio'         => $searchModel->getNumeroDY('07'),
            'agosto'         => $searchModel->getNumeroDY('08'),
            'septiembre'         => $searchModel->getNumeroDY('09'),
            'octubre'         => $searchModel->getNumeroDY('10'),
            'noviembre'         => $searchModel->getNumeroDY('11'),
            'diciembre'         => $searchModel->getNumeroDY('12'),


        ],
        '3' => [
            'gerencia'          => 'Contruccion y Mantenimiento de Pozos',
            'enero'         => $searchModel->getNumeroCMP('01'),
            'febrero'         => $searchModel->getNumeroCMP('02'),
            'marzo'         => $searchModel->getNumeroCMP('03'),
            'abril'         => $searchModel->getNumeroCMP('04'),
            'mayo'         => $searchModel->getNumeroCMP('05'),
            'junio'         => $searchModel->getNumeroCMP('06'),
            'julio'         => $searchModel->getNumeroCMP('07'),
            'agosto'         => $searchModel->getNumeroCMP('08'),
            'septiembre'         => $searchModel->getNumeroCMP('09'),
            'octubre'         => $searchModel->getNumeroCMP('10'),
            'noviembre'         => $searchModel->getNumeroCMP('11'),
            'diciembre'         => $searchModel->getNumeroCMP('12'),


        ],
        '4' => [
            'gerencia'          => 'Operaciones de Producción',
            'enero'         => $searchModel->getNumeroOP('01'),
            'febrero'         => $searchModel->getNumeroOP('02'),
            'marzo'         => $searchModel->getNumeroOP('03'),
            'abril'         => $searchModel->getNumeroOP('04'),
            'mayo'         => $searchModel->getNumeroOP('05'),
            'junio'         => $searchModel->getNumeroOP('06'),
            'julio'         => $searchModel->getNumeroOP('07'),
            'agosto'         => $searchModel->getNumeroOP('08'),
            'septiembre'         => $searchModel->getNumeroOP('09'),
            'octubre'         => $searchModel->getNumeroOP('10'),
            'noviembre'         => $searchModel->getNumeroOP('11'),
            'diciembre'         => $searchModel->getNumeroOP('12'),


        ],
        '5' => [
            'gerencia'          => 'Otras Organizaciones',
            'enero'         => $searchModel->getNumeroOOGG('01'),
            'febrero'         => $searchModel->getNumeroOOGG('02'),
            'marzo'         => $searchModel->getNumeroOOGG('03'),
            'abril'         => $searchModel->getNumeroOOGG('04'),
            'mayo'         => $searchModel->getNumeroOOGG('05'),
            'junio'         => $searchModel->getNumeroOOGG('06'),
            'julio'         => $searchModel->getNumeroOOGG('07'),
            'agosto'         => $searchModel->getNumeroOOGG('08'),
            'septiembre'         => $searchModel->getNumeroOOGG('09'),
            'octubre'         => $searchModel->getNumeroOOGG('10'),
            'noviembre'         => $searchModel->getNumeroOOGG('11'),
            'diciembre'         => $searchModel->getNumeroOOGG('12'),


        ],

    ];

    //echo '<pre>'; print_r($resultDataOrganizacion); echo '</pre>';
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
    $gerencias =['Estudios Integrados','Desarrollo de Yacimientos','Contrucción y Mantenimiento de pozos','Operaciones de Producción','Otras Organizaciones'];
    $eeii=['','','','','','','','','','','',''];
    $ddyy=['','','','','','','','','','','',''];
    $oopp=['','','','','','','','','','','',''];
    $cmpp=['','','','','','','','','','','',''];
    $oogg=['','','','','','','','','','','',''];
    for($i=0;$i<12;$i++)
    {
        $eeii[$i]=$searchModel->getNumeroEEII($i+1)+0;
        $ddyy[$i]=$searchModel->getNumeroDY($i+1)+0;
        $cmpp[$i]=$searchModel->getNumeroCMP($i+1)+0;
        $oopp[$i]=$searchModel->getNumeroOP($i+1)+0;
        $oogg[$i]=$searchModel->getNumeroOOGG($i+1)+0;
    }
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

            'title' => ['text' => 'Organizaciones Atendidas en '.$meses[(date('d')>25? Yii::$app->formatter->asDate(date('Y').'-'.(date('m')+1).'-01','php:n'):date('n'))]],
            'credits' => ['enabled' => false],
            'plotOptions' => [
                'pie' => [
                    'allowPointSelect'=> true,
                    'cursor'=>'pointer',
                    'tooltip'=>[
                        'pointFormat'=>'<b>{point.percentage:.1f}%</b>',
                    ],
                    'dataLabels'=> [
                        'enabled'=> true,
                        'format'=> '<b>{point.name}</b>: {point.percentage:.1f} %',
                    ],
                    'showInLegend'=> true,
                ],
            ],
            'series' => [
                [ // new opening bracket
                    'type' => 'pie',
                    'name' => 'Porcentaje',
                    'data' => [
                        ['Estudios Integrados', $searchModel->getNumeroEEII(date('d')>25?date('m'):date('m'))*100/$totalmes],
                        ['Desarrollo de Yacimientos', $searchModel->getNumeroDY(date('d')>25?date('m'):date('m'))*100/$totalmes],
                        ['Construcción y Mantenimiento de pozo', $searchModel->getNumeroCMP(date('d')>25?date('m'):date('m'))*100/$totalmes],
                        ['Operaciones de Producción', $searchModel->getNumeroOP(date('d')>25?date('m'):date('m'))*100/$totalmes],
                        ['Otras Organizaciones', $searchModel->getNumeroOOGG(date('d')>25?date('m'):date('m'))*100/$totalmes],
                    ],
                ] // new closing bracket
            ],
        ],
    ]);
    '</div>';
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
            'series' => [
                ['name' => 'Estudios Integrados', 'data' => $eeii,'type'=> 'column',],
                ['name' => 'Desarrollo de Yacimientos', 'data' => $ddyy,'type'=> 'column',],
                ['name' => 'Construcción y Mantenimiento de pozo', 'data' => $cmpp,'type'=> 'column',],
                ['name' => 'Operaciones de Producción', 'data' => $oopp,'type'=> 'column',],
                ['name' => 'Otras Organizaciones', 'data' => $oogg,'type'=> 'column',],


            ],

        ]
    ]);
    '</div>';
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

                ['name' => 'Estudios Integrados', 'data' => $eeii,'type'=> 'line',],
                ['name' => 'Desarrollo de Yacimientos', 'data' => $ddyy,'type'=> 'line',],
                ['name' => 'Construcción y Mantenimiento de pozo', 'data' => $cmpp,'type'=> 'line',],
                ['name' => 'Operaciones de Producción', 'data' => $oopp,'type'=> 'line',],
                ['name' => 'Otras Organizaciones', 'data' => $oogg,'type'=> 'line',],

            ],

        ]
    ]);


    $dataProviderOrganizacion = new ArrayDataProvider([
        'allModels' => $resultDataOrganizacion,
        'sort' => [
            'attributes' => ['gerencia', 'enero','febrero','marzo','abril','mayo','junio','julio','agosto','septiembre','octubre','noviembre','diciembre']
        ],
        'pagination' => [
            'pageSize' => 10,
        ],
    ]);
    echo '<div><h3>Organizaciones atendidas por cantidad de requerimientos</h3></div>';
    echo GridView::widget([
            'dataProvider' => $dataProviderOrganizacion,
            //'filterModel' => $searchModel,
            'columns' => ['gerencia', 'enero','febrero','marzo','abril','mayo','junio','julio','agosto','septiembre','octubre','noviembre','diciembre']
        ]
    );
    $resultDataOrganizacion = [
        '1' => [
            'gerencia'          => 'Estudios Integrados',
            'enero'         => $searchModel->getHHEEII('01'),
            'febrero'         => $searchModel->getHHEEII('02'),
            'marzo'         => $searchModel->getHHEEII('03'),
            'abril'         => $searchModel->getHHEEII('04'),
            'mayo'         => $searchModel->getHHEEII('05'),
            'junio'         => $searchModel->getHHEEII('06'),
            'julio'         => $searchModel->getHHEEII('07'),
            'agosto'         => $searchModel->getHHEEII('08'),
            'septiembre'         => $searchModel->getHHEEII('09'),
            'octubre'         => $searchModel->getHHEEII('10'),
            'noviembre'         => $searchModel->getHHEEII('11'),
            'diciembre'         => $searchModel->getHHEEII('12'),


        ],
        '2' => [
            'gerencia'          => 'Desarrollo de Yacimientos',
            'enero'         => $searchModel->getHHDY('01'),
            'febrero'         => $searchModel->getHHDY('02'),
            'marzo'         => $searchModel->getHHDY('03'),
            'abril'         => $searchModel->getHHDY('04'),
            'mayo'         => $searchModel->getHHDY('05'),
            'junio'         => $searchModel->getHHDY('06'),
            'julio'         => $searchModel->getHHDY('07'),
            'agosto'         => $searchModel->getHHDY('08'),
            'septiembre'         => $searchModel->getHHDY('09'),
            'octubre'         => $searchModel->getHHDY('10'),
            'noviembre'         => $searchModel->getHHDY('11'),
            'diciembre'         => $searchModel->getHHDY('12'),


        ],
        '3' => [
            'gerencia'          => 'Contruccion y Mantenimiento de Pozos',
            'enero'         => $searchModel->getHHCMP('01'),
            'febrero'         => $searchModel->getHHCMP('02'),
            'marzo'         => $searchModel->getHHCMP('03'),
            'abril'         => $searchModel->getHHCMP('04'),
            'mayo'         => $searchModel->getHHCMP('05'),
            'junio'         => $searchModel->getHHCMP('06'),
            'julio'         => $searchModel->getHHCMP('07'),
            'agosto'         => $searchModel->getHHCMP('08'),
            'septiembre'         => $searchModel->getHHCMP('09'),
            'octubre'         => $searchModel->getHHCMP('10'),
            'noviembre'         => $searchModel->getHHCMP('11'),
            'diciembre'         => $searchModel->getHHCMP('12'),


        ],
        '4' => [
            'gerencia'          => 'Operaciones de Producción',
            'enero'         => $searchModel->getHHOP('01'),
            'febrero'         => $searchModel->getHHOP('02'),
            'marzo'         => $searchModel->getHHOP('03'),
            'abril'         => $searchModel->getHHOP('04'),
            'mayo'         => $searchModel->getHHOP('05'),
            'junio'         => $searchModel->getHHOP('06'),
            'julio'         => $searchModel->getHHOP('07'),
            'agosto'         => $searchModel->getHHOP('08'),
            'septiembre'         => $searchModel->getHHOP('09'),
            'octubre'         => $searchModel->getHHOP('10'),
            'noviembre'         => $searchModel->getHHOP('11'),
            'diciembre'         => $searchModel->getHHOP('12'),


        ],
        '5' => [
            'gerencia'          => 'Otras Organizaciones',
            'enero'         => $searchModel->getHHOOGG('01'),
            'febrero'         => $searchModel->getHHOOGG('02'),
            'marzo'         => $searchModel->getHHOOGG('03'),
            'abril'         => $searchModel->getHHOOGG('04'),
            'mayo'         => $searchModel->getHHOOGG('05'),
            'junio'         => $searchModel->getHHOOGG('06'),
            'julio'         => $searchModel->getHHOOGG('07'),
            'agosto'         => $searchModel->getHHOOGG('08'),
            'septiembre'         => $searchModel->getHHOOGG('09'),
            'octubre'         => $searchModel->getHHOOGG('10'),
            'noviembre'         => $searchModel->getHHOOGG('11'),
            'diciembre'         => $searchModel->getHHOOGG('12'),


        ],

    ];
    $dataProviderOrganizacion = new ArrayDataProvider([
        'allModels' => $resultDataOrganizacion,
        'sort' => [
            'attributes' => ['gerencia', 'enero','febrero','marzo','abril','mayo','junio','julio','agosto','septiembre','octubre','noviembre','diciembre']
        ],
        'pagination' => [
            'pageSize' => 10,
        ],
    ]);
    echo '<div><h3>Organizaciones atendidas por horas hombre</h3></div>';
    echo GridView::widget([
            'dataProvider' => $dataProviderOrganizacion,
            //'filterModel' => $searchModel,
            'columns' => ['gerencia', 'enero','febrero','marzo','abril','mayo','junio','julio','agosto','septiembre','octubre','noviembre','diciembre']
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

    <?php
    echo '<div><h3>numero</h3></div>';
    echo GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                /*['class' => 'yii\grid\SerialColumn'],*/
                'id_macro',
                [
                    'attribute'=>'id_macro',
                    'label'=>'Actividad Macro',
                    'value'=>'macroNombre',
                ],
                [
                    'label' => 'Enero', 'format' => 'html',
                    'value' => function($data){
                        return $data::getNumeroActividades($data->id_macro,"01");
                    }
                ],

            ],
        ]
    ); ?>
    </div>