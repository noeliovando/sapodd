<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\User */

$this->title = $model->nombre.' '.$model->apellido;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Yii::$app->user->identity->rol_id=='2'? Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']):'' ?>
        <?= Yii::$app->user->identity->rol_id=='2'? Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]):'' ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'username',
            'auth_key',
            'password_hash',
            'password_reset_token',
            'email:email',
            'status',
            'created_at',
            'updated_at',
            [
                'label' => 'Rol',
                'value' => $model->rol->nombre,
            ],
            'supervisor',
            'nombre',
            'apellido',
            'cedula',
            [
                'label' => 'Organizacion',
                'value' => $model->organizacion->nombre,
            ],
            'id_distrito',
            [
                'label' => 'Division',
                'value' => $model->division->nombre,
            ],
            'id_proceso',
            'id_suproceso',
            'departamento',
            'telefono',
        ],
    ]) ?>
    <?php
    if(Yii::$app->user->identity->rol_id) {
        echo '<h2>Aplicaciones</h2>';
        foreach ($model->aplicacionesPermitidasList as $aplicacionesPermitidas) {

            echo $aplicacionesPermitidas['nombre'] . '<br>';
        }
    }
    ?>

</div>
