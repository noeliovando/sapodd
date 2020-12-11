<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Estadistica */

$this->title = 'Create Estadistica';
$this->params['breadcrumbs'][] = ['label' => 'Estadisticas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="estadistica-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
