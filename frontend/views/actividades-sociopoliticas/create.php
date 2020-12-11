<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\ActividadesSociopoliticas */

$this->title = 'Crear Actividade Sociopolitica';
$this->params['breadcrumbs'][] = ['label' => 'Actividades Sociopoliticas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="actividades-sociopoliticas-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
