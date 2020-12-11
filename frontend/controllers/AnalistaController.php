<?php

namespace frontend\controllers;

use frontend\models\AplicacionesDb;
use Yii;
use frontend\models\Analista;
use frontend\models\search\AnalistaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AnalistaController implements the CRUD actions for Analista model.
 */
class AnalistaController extends BaseController
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
     * Lists all Analista models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AnalistaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Analista model.
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
     * Creates a new Analista model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Analista();
        if(Yii::$app->user->identity->rol_id=='2'){
            $tipoAplicaciones = AplicacionesDb::find()->all();
            $model->setPassword();
            $model->generateAuthKey();
            $model->aplicaciones = \yii\helpers\ArrayHelper::getColumn(
                $model->getAplicacionUsuario()->asArray()->all(),
                'id_aplicaciones'
            );
        }
        if ($model->load(Yii::$app->request->post())) {
            if (!isset($_POST['User']['aplicaciones'])&&Yii::$app->user->identity->rol_id=='2') {
                $model->aplicaciones = [];
            }
            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            return $this->render('update', [
                'model' => $model,
                'tipoAplicaciones' => Yii::$app->user->identity->rol_id=='2'? $tipoAplicaciones:''
            ]);
        }
    }

    /**
     * Updates an existing Analista model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $tipoAplicaciones = AplicacionesDb::find()->orderBy(['nombre' => SORT_ASC])->all();

            $model->aplicaciones = \yii\helpers\ArrayHelper::getColumn(
                $model->getAplicacionUsuario()->asArray()->all(),
                'id_aplicacion'
            );

        if ($model->load(Yii::$app->request->post())) {

            $model->modificarApp();
            return $this->redirect(['view', 'id' => $model->id]);

        } else {
            return $this->render('update', [
                'model' => $model,
                'tipoAplicaciones' => $tipoAplicaciones
            ]);
        }

    }

    /**
     * Deletes an existing Analista model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Analista model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Analista the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Analista::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
