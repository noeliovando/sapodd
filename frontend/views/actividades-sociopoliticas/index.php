<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\search\ActividadesSociopoliticasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Actividades Sociopoliticas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="actividades-sociopoliticas-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php if(Yii::$app->user->identity->rol_id=='3') echo Html::a('Crear Actividades Sociopoliticas', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'descripcion:ntext',
            'fecha',
            [
                'attribute'=>'id_analista',
                'filter'=>$searchModel->getAnalista(),
                'label'=>'Analista',
                'value'=>'nombreCompleto',
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'template'=>'{update}{delete}',
                'visible'=>Yii::$app->user->identity->rol_id=='3',
                'buttons' => [
                    'delete' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
                            'title' => Yii::t('app', 'Delete'),
                            'data-confirm'=>'¿Estas Seguro que deseas borrar la actividad?',
                            'data-method'=>'POST',
                        ]);
                    }
                ]
            ],
        ],
    ]); ?>

</div>
