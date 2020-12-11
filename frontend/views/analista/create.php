<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Analista */

$this->title = 'Create Analista';
$this->params['breadcrumbs'][] = ['label' => 'Analistas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="analista-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'tipoAplicaciones' => $tipoAplicaciones
    ]) ?>

</div>
