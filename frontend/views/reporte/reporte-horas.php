<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\search\ReporteHorasSearch */
/* @var $dataProvider yii\data\ArrayDataProvider */
/* @var $model frontend\models\ReporteHoras */

$this->title = 'Reporte por Horas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reporte-horas-index">

    <h2><?= Html::encode($this->title) ?></h2>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


    <?php
    echo '<div><h3>Reporte por horas</h3></div>';
    echo GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                /*['class' => 'yii\grid\SerialColumn'],*/
                [
                    'attribute'=>'id_macro',
                    'label'=>'Actividad Macro',
                    'filter'=>$searchModel->getActividadMacro(),
                    'value'=>'macroNombre',
                ],
                [
                    'label' => 'Horas totales Año', 'format' => 'html',
                    'value' => function($data){
                        return $data::getHorasActividades($data->id_macro);
                    }
                ],
            ],
        ]
    );

    ?>
    </div>