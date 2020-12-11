<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\ActividadesComplementarias */

$this->title = 'Update Actividades Complementarias: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Actividades Complementarias', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="actividades-complementarias-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
