<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\ActividadesResaltantes */

$this->title = 'Modificar Actividades Resaltantes: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Actividades Resaltantes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="actividades-resaltantes-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
