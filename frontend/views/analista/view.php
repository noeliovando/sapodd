<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Analista */

$this->title = 'Aplicaciones: ' . ' ' . $model->nombre.' '.$model->apellido;
$this->params['breadcrumbs'][] = ['label' => 'Analistas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->nombre.' '.$model->apellido;
?>
<div class="analista-view">

    <h1><?= Html::encode($this->title) ?></h1>



    <?php

    foreach ($model->aplicacionesPermitidasList as $aplicacionesPermitidas) {

        echo $aplicacionesPermitidas['nombre'].'<br>';
    }

    ?>

</div>
