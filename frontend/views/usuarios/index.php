<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\search\UsuariosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Usuarios';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="usuarios-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Crear Usuarios', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Yii::$app->user->identity->rol_id=='2'? $buttons='{view}{delete}{update}': $buttons='';
    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'indicador',
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
