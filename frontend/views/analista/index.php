<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\search\AnalistaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Analistas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="analista-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

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
            'cedula',
            'telefono',
            // 'id_organizacion',
            // 'id_distrito',
            // 'id_division',
            // 'id_proceso',
            // 'id_suproceso',

            [
                'class' => 'yii\grid\ActionColumn',
                'template'=>'{update}'
            ],
        ],
    ]); ?>

</div>
