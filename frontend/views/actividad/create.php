<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Actividad */

$this->title = 'Crear Actividad';
$this->params['breadcrumbs'][] = ['label' => 'Actividads', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="actividad-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'aplicaciones'=>$aplicaciones,
    ]) ?>

</div>
