<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\export\ExportMenu;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\search\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Usuarios';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Crear Usuario', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php
    $gridColumns = [
        ['class' => 'kartik\grid\SerialColumn'],
        //'id',
        'username',
        //'auth_key',
        //'password_hash',
        //'password_reset_token',
        // 'email:email',
        // 'status',
        // 'created_at',
        // 'updated_at',
        // 'rol_id',
        // 'id_supervisor',
        'nombre',
        'apellido',
        // 'cedula',
        [
            'label' => 'Organizacion',
            'attribute' => 'organizacionNombre',
        ],
        [
            'label' => 'Aplicacion',
            'attribute' => 'aplicacionNombre',
        ],
        [
            'label' => 'Division',
            'attribute' => 'divisionNombre',
        ],
        [
            'label' => 'Distrito',
            'attribute' => 'distritoNombre',
        ],
        [
            'label' => 'Empresa',
            'attribute' => 'empresaNombre',
        ],
        // 'id_organizacion',
        // 'id_distrito',
        // 'id_division',
        // 'id_proceso',
        // 'id_suproceso',
        //['class' => 'kartik\grid\ActionColumn', 'urlCreator'=>function(){return '#';}]
    ];
    echo ExportMenu::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => $gridColumns,
        'fontAwesome' => true,
    ]);
    ?>

    <?php
    Yii::$app->user->identity->rol_id=='2'? $buttons='{view}{delete}{update}': $buttons='';
    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'username',
             'nombre',
             'apellido',
            [
                'attribute'=>'id_division',
                'filter'=>$searchModel->getDivisiones(),
                'label'=>'Division',
                'value'=>'divisionNombre',
            ],
            [
                'attribute'=>'id_aplicacion',
                'filter'=>$searchModel->getAplicaciones(),
                'label'=>'Aplicacion/BD',
                'value'=>'aplicacionNombre',
            ],
            [
                'attribute'=>'id_distrito',
                'filter'=>$searchModel->getDistritos(),
                'label'=>'Distrito',
                'value'=>'distritoNombre',
            ],
            [
                'attribute'=>'id_organizacion',
                'filter'=>$searchModel->getOrganizaciones(),
                'label'=>'Organización',
                'value'=>'organizacionNombre',
            ],
            [
                'attribute'=>'id_empresa',
                'filter'=>$searchModel->getEmpresas(),
                'label'=>'Empresa',
                'value'=>'empresaNombre',
            ],

            //'email',
            //'supervisor',
            //'departamento',
            //'telefono',
            [
                'class' => 'yii\grid\ActionColumn',
                'visible'=>Yii::$app->user->identity->rol_id=='2'
            ],
        ],
    ]); ?>

</div>
