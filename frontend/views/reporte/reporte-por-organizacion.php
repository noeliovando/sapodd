<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\search\ReporteHorasSearch */
/* @var $dataProvider yii\data\ArrayDataProvider */
/* @var $model frontend\models\ReporteHoras */

$this->title = 'Reporte por Organizacion';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reporte-horas-index">

    <h2><?= Html::encode($this->title) ?></h2>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


    <?php
    echo '<div><h3>Reporte por Numero de Actividades</h3></div>';
    echo GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                /*['class' => 'yii\grid\SerialColumn'],*/
                [
                    'attribute'=>'id_organizacion',
                    'label'=>'Organizacion',
                    'filter'=>$searchModel->getOrganizaciones(),
                    'value'=>'organizacionNombre',
                ],
                [
                    'label' => 'Horas totales Año', 'format' => 'html',
                    'value' => function($data){
                        return $data::getHorasOrganizaciones($data->id_proyecto);
                    }
                ],
            ],
        ]
    );

    ?>
    </div>