<?php

namespace frontend\controllers;

use frontend\models\User;
use Yii;
use frontend\models\Actividad;
use frontend\models\search\ActividadSearch;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;


/**
 * ActividadController implements the CRUD actions for Actividad model.
 */
class ActividadController extends BaseController
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Actividad models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ActividadSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Actividad model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Actividad model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        /* @var $user User */
        $model = new Actividad();
        $user =User::findOne(Yii::$app->user->id);
        $aplicaciones = ArrayHelper::map($user->aplicacionesDb,'id','nombre');
        if ($model->load(Yii::$app->request->post())) {
            $model->setHorasHombre();
            $model->setOrganizacion();
            $model->setEmpresa();
            if($model->save()){
                $model->reajustarCodigos();
                return $this->redirect(['view', 'id' => $model->id_actividad]);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
                'aplicaciones'=>$aplicaciones,
            ]);
        }
    }

    /**
     * Updates an existing Actividad model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $actividades="";
        $model = $this->findModel($id);
        $user =User::findOne(Yii::$app->user->id);
        $aplicaciones = ArrayHelper::map($user->aplicacionesDb,'id','nombre');
        if ($model->load(Yii::$app->request->post())) {
            $model->setHorasHombre();
            $model->setOrganizacion();
            $model->setEmpresa();
            if($model->save()){
                $actividades=$model->reajustarCodigos();
                //echo '<pre>'; print_r($actividades); echo '</pre>';
                return $this->redirect(['view', 'id' => $model->id_actividad,]);
            }
        } else {
            return $this->render('update', [
                'model' => $model,
                'aplicaciones'=>$aplicaciones,
            ]);
        }
    }

    /**
     * Deletes an existing Actividad model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = new Actividad();
        $this->findModel($id)->delete();
        $model->reajustarCodigos();
        return $this->redirect(['index']);
    }
    public function actionClonar($id)
    {
        $model = $this->findModel($id);
        $obj = Actividad::find()->where(['id_actividad'=>$id])->one();
        //$fechar = StringHelper::explode(ArrayHelper::getValue($obj,'fecha_requerimiento'),'-');
        //$fechaa = StringHelper::explode(ArrayHelper::getValue($obj,'fecha_atencion'),'-');
        $fechar = ArrayHelper::getValue($obj,'fecha_requerimiento');
        $fechaa = ArrayHelper::getValue($obj,'fecha_atencion');
        //$diar=$fechar[2];
        //$diaa=$fechaa[2];
        $clone = New Actividad([
            'attributes'=>$obj->getAttributes(),
            'codigo_caso'=> $obj->getCodigoActividad(),
            //'fecha_requerimiento'=>$fechar[0].'-'.$fechar[1].'-'.$diar,
            //'fecha_atencion'=>$fechaa[0].'-'.$fechaa[1].'-'.$diaa,
            'fecha_requerimiento'=>$fechar,
            'fecha_atencion'=>$fechaa,
        ]);
        $clone->save();
        $model->reajustarCodigos();
        return $this->render('view', [
            'model' => $this->findModel($clone->id_actividad),
        ]);

    }

    /**
     * Finds the Actividad model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Actividad the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Actividad::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('La pagina solicitada no existe.');
        }
    }

    public function actionAjaxSumar(){
        $id = $_POST["id"];
        $a = $_POST["a"];
        $b = $_POST["b"];
        $c = $_POST["c"];
        if($model = XX::model()->findByPk($id)){
            header("Content-type: application/json");
            echo json_encode($model->calcular($a,$b,$c));
        }
    }

}
