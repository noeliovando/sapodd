<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Usuarios */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Usuarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="usuarios-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Modificar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Eliminar', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [

            'indicador',
            'nombre',
            'apellido',
            [
                'label'=>'Division',
                'value'=>$model->division->nombre,
            ],
            [
                'label'=>'Aplicacion/BD',
                'value'=>$model->aplicacion->nombre,
            ],
            [
                'label'=>'Organización',
                'value'=>$model->organizacion->nombre,
            ],
            [
                'label'=>'Empresa',
                'value'=>$model->empresa->nombre,
            ],
        ],
    ]) ?>

</div>
