<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\ActividadesComplementarias */

$this->title = 'Create Actividades Complementarias';
$this->params['breadcrumbs'][] = ['label' => 'Actividades Complementarias', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="actividades-complementarias-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
