<?php


namespace frontend\controllers;

use frontend\models\Organizacion;
use yii\web\Controller;
use common\models\HtmlHelpers;
use frontend\models\ActividadDetallada;

class DependentDropdownController extends Controller
{
    public function actionIndex()
    {
        $this->render('index');
    }

    public function actionDetallada($id)
    {
        //echo HtmlHelpers::dropDownList(ActividadDetallada::className(), 'id_macro', $id, 'id', 'nombre');
        $rows = ActividadDetallada::find()->where(['id_macro' => $id])->all();

        echo "<option>Selecione una Actividad Detallada</option>";

        if (count($rows) > 0) {
            foreach ($rows as $row) {
                echo "<option value='".$row['id']."'>".$row['nombre']."</option>";
            }
        } else {
            echo "<option>Ninguna actividad detallada encontrada</option>";
        }
    }
    public function actionOrganizacion($id)
    {
        //echo HtmlHelpers::dropDownList(ActividadDetallada::className(), 'id_macro', $id, 'id', 'nombre');
        $rows = User::find()->where(['id' => $id])->one();

        echo "<option>Selecione una Actividad Detallada</option>";
        if (count($rows) > 0) {
            foreach ($rows as $row) {
                echo "<option value='".$row['id_organizacion']."'>".$row['id_organizacion']."</option>";
            }
        } else {
            echo "<option>Ninguna actividad detallada encontrada</option>";
        }
    }



    public function actionLists($id)
    {
        $countPosts = ActividadDetallada::find()
            ->where(['id_macro' => $id])
            ->count();

        $posts = ActividadDetallada::find()
            ->where(['id_macro' => $id])
            ->orderBy('id DESC')
            ->all();

        if ($countPosts > 0) {
            foreach ($posts as $post) {
                echo "<option value='" . $post->id . "'>" . $post->nombre . "</option>";
            }
        } else {
            echo "<option>-</option>";
        }

    }
}