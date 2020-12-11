<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\ActividadesResaltantes */

$this->title = 'Crear Actividade Resaltante';
$this->params['breadcrumbs'][] = ['label' => 'Actividades Resaltantes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="actividades-resaltantes-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
