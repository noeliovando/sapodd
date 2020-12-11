<?php

namespace frontend\models\search;

use frontend\models\ActividadDetallada;
use frontend\models\ActividadMacro;
use frontend\models\Organizacion;
use frontend\models\Plan;
use frontend\models\User;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Reporte;
use yii\helpers\ArrayHelper;

/**
 * ReporteSearch represents the model behind the search form about `frontend\models\Reporte`.
 */
class ReporteSearch extends Reporte
{
    public $mes;
    public $anio;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_actividad', 'id_subproceso', 'id_usuario', 'id_via', 'id_bd', 'id_organizacion', 'id_empresa', 'id_proyecto', 'id_dato_cargado', 'id_macro', 'id_detallada', 'id_status'], 'integer'],
            [['codigo_caso', 'id_analista', 'fecha_requerimiento', 'hora_requerimiento', 'fecha_atencion', 'hora_ini', 'hora_fin', 'detalle'], 'safe'],
            [['HH'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $anio=date('Y');
        $desde = ($anio-1).'-'.'12'.'-25';
        $hasta = $anio.'-12-31';
        //$query = Reporte::find();
        $query = Reporte::find()->joinWith('idDetallada')->groupBy('{{actividad_detallada}}.id');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id_actividad' => $this->id_actividad,
            '{{actividad_detallada}}.id' => $this->id_detallada,
        ]);
        $query->andFilterWhere([
            //'user.id_division' => Yii::$app->user->identity->id_division,
            'user.id_proceso' => Yii::$app->user->identity->id_proceso,
        ]);

        $query->andFilterWhere(['like', 'codigo_caso', $this->codigo_caso])
            ->andFilterWhere(['like', 'id_analista', $this->id_analista])
            ->andFilterWhere(['like', 'detalle', $this->detalle])
            ->andFilterWhere(['>=', 'fecha_requerimiento', $desde])
            ->andFilterWhere(['<=', 'fecha_requerimiento', $hasta]);

        $query->joinWith(['idAnalista' => function ($q) {
            $q->where('user.id_division = "' . Yii::$app->user->identity->id_division . '"');
        }]);

        return $dataProvider;
    }
    public function getTrabajadores()
    {
        return $this->hasOne(User::className(),['id' =>'id_trabajador']);
    }
    public function getTrabajoresNombres(){
        $datos = User::find()
            ->asArray()
            ->andWhere(['id_proceso'=>'1'])
            ->andWhere(['status'=>10])
            ->andWhere(['rol_id'=> '3'])
            ->andWhere(['id_division'=> Yii::$app->user->identity->id_division])
            ->all();
        return ArrayHelper::map($datos,'id','username');
    }
    public function getTrabajorNombre(){
        $nombre = User::find()
            ->asArray()
            ->andWhere(['id'=>Yii::$app->user->identity->id])
            ->one();
        return ArrayHelper::getValue($nombre,'nombre');
    }
    public function getTrabajoresId(){
        $datos = User::find()
            ->asArray()
            ->andWhere(['id_proceso'=>'1'])
            ->andWhere(['rol_id'=> '3'])
            ->andWhere(['status'=>10])
            ->andWhere(['id_division'=> Yii::$app->user->identity->id_division])
            ->all();
        return ArrayHelper::map($datos,'id','id');
    }
    public function getOrganizacionesId(){
        $datos = Organizacion::find()
            ->asArray()
            ->all();
        return ArrayHelper::map($datos,'id','id');
    }
    public function getOrganizacionesNombres(){
        $datos = Organizacion::find()
            ->asArray()
            ->all();
        return ArrayHelper::map($datos,'id','nombre');
    }
    public function getCantidadServicios($id_organizacion){
        if(date('d')>=25&&date('d')<=31)
            $fecha=date('m')+1;
        else
            $fecha=date('m')+0;
        for($i=0;$i<$fecha;$i++) {
            $mes=$i+1;
            $anio=date('Y');
            if(($mes-1)<1)
                $desde = ($anio-1).'-'.'12'.'-25';
            else
                $desde = $anio.'-'.($mes-1).'-25';
            $hasta = $anio.'-'.$mes.'-24';
            $count = $this::find()
                ->andWhere(['id_organizacion'=> $id_organizacion])
                ->andwhere(['>=', 'fecha_requerimiento', $desde])
                ->andwhere(['<=', 'fecha_requerimiento', $hasta])
                ->count();
            $cantidadServicios[$i]=$count+0;
        }
        return $cantidadServicios;
    }



    /********************************OLD**********************************************/
    public function getIdDetallada()
    {
        return $this->hasOne(ActividadDetallada::className(), ['id' => 'id_detallada']);
    }

    public function getDetalladaNombre()
    {
        return $this->idDetallada? $this->idDetallada->nombre: 'Vacio';
    }


    public function getNroPSF($mes)
    {

        $anio=date('Y');
        if($mes==1)
            $desde = ($anio-1).'-'.'12'.'-25';
        else
            $desde = $anio.'-'.($mes-1).'-25';
        $hasta = $anio.'-'.$mes.'-24';
        $count = $this::find()
            ->andwhere(['>=', 'fecha_requerimiento', $desde])
            ->andwhere(['<=', 'fecha_requerimiento', $hasta])
            ->andwhere(['=', 'actividad.id_empresa', '1'])
            ->joinWith(['idAnalista' => function ($q) {
                $q->where('user.id_division = "' . Yii::$app->user->identity->id_division . '"');
            }])
            ->joinWith(['idAnalista' => function ($q) {
                $q->where('user.id_proceso = "' . Yii::$app->user->identity->id_proceso . '"');
            }])

            ->count();
        return $count;
    }
    public function getNroPJ($mes)
    {
        $anio=date('Y');

        if($mes==1)
            $desde = ($anio-1).'-'.'12'.'-25';
        else
            $desde = $anio.'-'.($mes-1).'-25';
        $hasta = $anio.'-'.$mes.'-24';
        $count = $this::find()
            ->andwhere(['>=', 'fecha_requerimiento', $desde])
            ->andwhere(['<=', 'fecha_requerimiento', $hasta])
            ->andwhere(['=', 'actividad.id_empresa', '2'])
            ->joinWith(['idAnalista' => function ($q) {
                $q->where('user.id_division = "' . Yii::$app->user->identity->id_division . '"');
            }])
            ->joinWith(['idAnalista' => function ($q) {
                $q->where('user.id_proceso = "' . Yii::$app->user->identity->id_proceso . '"');
            }])
            ->count();
        return $count;
    }
    public function getNroPC($mes)
    {
        $anio=date('Y');
        if($mes==1)
            $desde = ($anio-1).'-'.'12'.'-25';
        else
            $desde = $anio.'-'.($mes-1).'-25';
        $hasta = $anio.'-'.$mes.'-24';
        $count = $this::find()
            ->andwhere(['>=', 'fecha_requerimiento', $desde])
            ->andwhere(['<=', 'fecha_requerimiento', $hasta])
            ->andwhere(['=', 'actividad.id_empresa', '3'])
            ->joinWith(['idAnalista' => function ($q) {
                $q->where('user.id_division = "' . Yii::$app->user->identity->id_division . '"');
            }])
            ->joinWith(['idAnalista' => function ($q) {
                $q->where('user.id_proceso = "' . Yii::$app->user->identity->id_proceso . '"');
            }])
            ->count();
        return $count;
    }
    public function getNroPM($mes)
    {
        $anio=date('Y');
        if($mes==1)
            $desde = ($anio-1).'-'.'12'.'-25';
        else
            $desde = $anio.'-'.($mes-1).'-25';
        $hasta = $anio.'-'.$mes.'-24';
        $count = $this::find()
            ->andwhere(['>=', 'fecha_requerimiento', $desde])
            ->andwhere(['<=', 'fecha_requerimiento', $hasta])
            ->andwhere(['=', 'actividad.id_empresa', '4'])
            ->joinWith(['idAnalista' => function ($q) {
                $q->where('user.id_division = "' . Yii::$app->user->identity->id_division . '"');
            }])
            ->joinWith(['idAnalista' => function ($q) {
                $q->where('user.id_proceso = "' . Yii::$app->user->identity->id_proceso . '"');
            }])
            ->count();
        return $count;
    }
    public function getNroPMI($mes)
    {
        $anio=date('Y');
        $sql = "SELECT COUNT(*) FROM actividad WHERE id_organizacion = 7";
        $count = Yii::$app->db->createCommand($sql)->queryScalar();
        if($mes==1)
            $desde = ($anio-1).'-'.'12'.'-25';
        else
            $desde = $anio.'-'.($mes-1).'-25';
        $hasta = $anio.'-'.$mes.'-24';
        $count = $this::find()
            ->andwhere(['>=', 'fecha_requerimiento', $desde])
            ->andwhere(['<=', 'fecha_requerimiento', $hasta])
            ->andwhere(['=', 'actividad.id_empresa', '5'])
            ->joinWith(['idAnalista' => function ($q) {
                $q->where('user.id_division = "' . Yii::$app->user->identity->id_division . '"');
            }])
            ->joinWith(['idAnalista' => function ($q) {
                $q->where('user.id_proceso = "' . Yii::$app->user->identity->id_proceso . '"');
            }])
            ->count();
        return $count;
    }
    public function getNroPU($mes)
    {
        $anio=date('Y');
        if($mes==1)
            $desde = ($anio-1).'-'.'12'.'-25';
        else
            $desde = $anio.'-'.($mes-1).'-25';
        $hasta = $anio.'-'.$mes.'-24';
        $count = $this::find()
            ->andwhere(['>=', 'fecha_requerimiento', $desde])
            ->andwhere(['<=', 'fecha_requerimiento', $hasta])
            ->andwhere(['=', 'actividad.id_empresa', '6'])
            ->joinWith(['idAnalista' => function ($q) {
                $q->where('user.id_division = "' . Yii::$app->user->identity->id_division . '"');
            }])
            ->joinWith(['idAnalista' => function ($q) {
                $q->where('user.id_proceso = "' . Yii::$app->user->identity->id_proceso . '"');
            }])
            ->count();
        return $count;
    }
    public function getNroINDO($mes)
    {
        $anio=date('Y');
        if($mes==1)
            $desde = ($anio-1).'-'.'12'.'-25';
        else
            $desde = $anio.'-'.($mes-1).'-25';
        $hasta = $anio.'-'.$mes.'-24';
        $count = $this::find()
            ->andwhere(['>=', 'fecha_requerimiento', $desde])
            ->andwhere(['<=', 'fecha_requerimiento', $hasta])
            ->andwhere(['=', 'actividad.id_empresa', '7'])
            ->joinWith(['idAnalista' => function ($q) {
                $q->where('user.id_division = "' . Yii::$app->user->identity->id_division . '"');
            }])
            ->joinWith(['idAnalista' => function ($q) {
                $q->where('user.id_proceso = "' . Yii::$app->user->identity->id_proceso . '"');
            }])
            ->count();
        return $count;
    }

    public function getNumeroEEII($mes)
    {
        $proceso='MD';
        if(Yii::$app->user->identity->id_proceso == 1)
            $proceso='MD';
        if(Yii::$app->user->identity->id_proceso == 2)
            $proceso='MC';
        if(Yii::$app->user->identity->id_proceso == 3)
            $proceso='SFT';

        $division ='Junin';
        if(Yii::$app->user->identity->id_division == 1)
            $division='Junin';
        if(Yii::$app->user->identity->id_division == 2)
            $division='Ayacucho';
        if(Yii::$app->user->identity->id_division == 3)
            $division='Carabobo';
        if(Yii::$app->user->identity->id_division == 4)
            $division='Boyaca';

        $anio=date('Y');
        //$sql = "SELECT COUNT(*) FROM actividad WHERE id_organizacion = 1 AND fecha_requerimiento =>".$anio."-".$mes."-01 AND fecha_requerimiento <=".$anio."-".$mes."-31";
        //$count = Yii::$app->db->createCommand($sql)->queryScalar();
        if($mes==1)
            $desde = ($anio-1).'-'.'12'.'-25';
        else
            $desde = $anio.'-'.($mes-1).'-25';
        $hasta = $anio.'-'.$mes.'-24';
        $count = $this::find()
            ->andwhere(['>=', 'fecha_requerimiento', $desde])
            ->andwhere(['<=', 'fecha_requerimiento', $hasta])
            ->andwhere(['=', 'id_organizacion', '1'])
            ->andwhere(['like','codigo_caso',$proceso])
            ->andWhere(['like','codigo_caso',$division])
            ->count();
        return $count;
    }

    public function getNumeroDY($mes)
    {
        $proceso='MD';
        if(Yii::$app->user->identity->id_proceso == 1)
            $proceso='MD';
        if(Yii::$app->user->identity->id_proceso == 2)
            $proceso='MC';
        if(Yii::$app->user->identity->id_proceso == 3)
            $proceso='SFT';

        $division ='Junin';
        if(Yii::$app->user->identity->id_division == 1)
            $division='Junin';
        if(Yii::$app->user->identity->id_division == 2)
            $division='Ayacucho';
        if(Yii::$app->user->identity->id_division == 3)
            $division='Carabobo';
        if(Yii::$app->user->identity->id_division == 4)
            $division='Boyaca';
        $anio=date('Y');
        //$sql = "SELECT COUNT(*) FROM actividad WHERE id_organizacion = 2";
        //$count = Yii::$app->db->createCommand($sql)->queryScalar();
        if($mes==1)
            $desde = ($anio-1).'-'.'12'.'-25';
        else
            $desde = $anio.'-'.($mes-1).'-25';
        $hasta = $anio.'-'.$mes.'-24';
        $count = $this::find()
            ->andwhere(['>=', 'fecha_requerimiento', $desde])
            ->andwhere(['<=', 'fecha_requerimiento', $hasta])
            ->andwhere(['=', 'id_organizacion', '2'])
            ->andwhere(['like','codigo_caso',$proceso])
            ->andWhere(['like','codigo_caso',$division])
            ->count();
        return $count;
    }
    public function getNumeroOP($mes)
    {
        $proceso='MD';
        if(Yii::$app->user->identity->id_proceso == 1)
            $proceso='MD';
        if(Yii::$app->user->identity->id_proceso == 2)
            $proceso='MC';
        if(Yii::$app->user->identity->id_proceso == 3)
            $proceso='SFT';

        $division ='Junin';
        if(Yii::$app->user->identity->id_division == 1)
            $division='Junin';
        if(Yii::$app->user->identity->id_division == 2)
            $division='Ayacucho';
        if(Yii::$app->user->identity->id_division == 3)
            $division='Carabobo';
        if(Yii::$app->user->identity->id_division == 4)
            $division='Boyaca';
        $anio=date('Y');
        //$sql = "SELECT COUNT(*) FROM actividad WHERE id_organizacion = 3";
        //$count = Yii::$app->db->createCommand($sql)->queryScalar();
        if($mes==1)
            $desde = ($anio-1).'-'.'12'.'-25';
        else
            $desde = $anio.'-'.($mes-1).'-25';
        $hasta = $anio.'-'.$mes.'-24';
        $count = $this::find()
            ->andwhere(['>=', 'fecha_requerimiento', $desde])
            ->andwhere(['<=', 'fecha_requerimiento', $hasta])
            ->andwhere(['=', 'id_organizacion', '3'])
            ->andwhere(['like','codigo_caso',$proceso])
            ->andWhere(['like','codigo_caso',$division])
            ->count();
        return $count;
    }
    public function getNumeroCMP($mes)
    {
        $proceso='MD';
        if(Yii::$app->user->identity->id_proceso == 1)
            $proceso='MD';
        if(Yii::$app->user->identity->id_proceso == 2)
            $proceso='MC';
        if(Yii::$app->user->identity->id_proceso == 3)
            $proceso='SFT';

        $division ='Junin';
        if(Yii::$app->user->identity->id_division == 1)
            $division='Junin';
        if(Yii::$app->user->identity->id_division == 2)
            $division='Ayacucho';
        if(Yii::$app->user->identity->id_division == 3)
            $division='Carabobo';
        if(Yii::$app->user->identity->id_division == 4)
            $division='Boyaca';
        $anio=date('Y');
        $sql = "SELECT COUNT(*) FROM actividad WHERE id_organizacion = 4";
        $count = Yii::$app->db->createCommand($sql)->queryScalar();
        if($mes==1)
            $desde = ($anio-1).'-'.'12'.'-25';
        else
            $desde = $anio.'-'.($mes-1).'-25';
        $hasta = $anio.'-'.$mes.'-24';
        $count = $this::find()
            ->andwhere(['>=', 'fecha_requerimiento', $desde])
            ->andwhere(['<=', 'fecha_requerimiento', $hasta])
            ->andwhere(['=', 'id_organizacion', '4'])
            ->andwhere(['like','codigo_caso',$proceso])
            ->andWhere(['like','codigo_caso',$division])
            ->count();
        return $count;
    }
    public function getNumeroOOGG($mes)
    {
        $proceso='MD';
        if(Yii::$app->user->identity->id_proceso == 1)
            $proceso='MD';
        if(Yii::$app->user->identity->id_proceso == 2)
            $proceso='MC';
        if(Yii::$app->user->identity->id_proceso == 3)
            $proceso='SFT';

        $division ='Junin';
        if(Yii::$app->user->identity->id_division == 1)
            $division='Junin';
        if(Yii::$app->user->identity->id_division == 2)
            $division='Ayacucho';
        if(Yii::$app->user->identity->id_division == 3)
            $division='Carabobo';
        if(Yii::$app->user->identity->id_division == 4)
            $division='Boyaca';
        $anio=date('Y');
        $sql = "SELECT COUNT(*) FROM actividad WHERE id_organizacion = 6 OR id_organizacion = 5";
        $count = Yii::$app->db->createCommand($sql)->queryScalar();
        if($mes==1)
            $desde = ($anio-1).'-'.'12'.'-25';
        else
            $desde = $anio.'-'.($mes-1).'-25';
        $hasta = $anio.'-'.$mes.'-24';
        $count = $this::find()
            ->andwhere(['>=', 'fecha_requerimiento', $desde])
            ->andwhere(['<=', 'fecha_requerimiento', $hasta])
            ->andwhere(['like','codigo_caso',$proceso])
            ->andWhere(['like','codigo_caso',$division])
            ->andwhere(['or','id_organizacion=6','id_organizacion=5'])
            ->count();
        return $count;
    }

    public function getNroPA($mes)
    {
        $proceso='MD';
        if(Yii::$app->user->identity->id_proceso == 1)
            $proceso='MD';
        if(Yii::$app->user->identity->id_proceso == 2)
            $proceso='MC';
        if(Yii::$app->user->identity->id_proceso == 3)
            $proceso='SFT';

        $division ='Junin';
        if(Yii::$app->user->identity->id_division == 1)
            $division='Junin';
        if(Yii::$app->user->identity->id_division == 2)
            $division='Ayacucho';
        if(Yii::$app->user->identity->id_division == 3)
            $division='Carabobo';
        if(Yii::$app->user->identity->id_division == 4)
            $division='Boyaca';
        $anio=date('Y');
        $sql = "SELECT COUNT(*) FROM actividad WHERE id_organizacion = 7";
        $count = Yii::$app->db->createCommand($sql)->queryScalar();
        if($mes==1)
            $desde = ($anio-1).'-'.'12'.'-25';
        else
            $desde = $anio.'-'.($mes-1).'-25';
        $hasta = $anio.'-'.$mes.'-24';
        $count = $this::find()
            ->andwhere(['>=', 'fecha_requerimiento', $desde])
            ->andwhere(['<=', 'fecha_requerimiento', $hasta])
            ->andwhere(['=', 'id_empresa', '8'])
            ->andwhere(['like','codigo_caso',$proceso])
            ->andWhere(['like','codigo_caso',$division])
            ->count();
        return $count;
    }
    public function getNroAP($mes)
    {
        $proceso='MD';
        if(Yii::$app->user->identity->id_proceso == 1)
            $proceso='MD';
        if(Yii::$app->user->identity->id_proceso == 2)
            $proceso='MC';
        if(Yii::$app->user->identity->id_proceso == 3)
            $proceso='SFT';

        $division ='Junin';
        if(Yii::$app->user->identity->id_division == 1)
            $division='Junin';
        if(Yii::$app->user->identity->id_division == 2)
            $division='Ayacucho';
        if(Yii::$app->user->identity->id_division == 3)
            $division='Carabobo';
        if(Yii::$app->user->identity->id_division == 4)
            $division='Boyaca';
        $anio=date('Y');
        $sql = "SELECT COUNT(*) FROM actividad WHERE id_organizacion = 7";
        $count = Yii::$app->db->createCommand($sql)->queryScalar();
        if($mes==1)
            $desde = ($anio-1).'-'.'12'.'-25';
        else
            $desde = $anio.'-'.($mes-1).'-25';
        $hasta = $anio.'-'.$mes.'-24';
        $count = $this::find()
            ->andwhere(['>=', 'fecha_requerimiento', $desde])
            ->andwhere(['<=', 'fecha_requerimiento', $hasta])
            ->andwhere(['=', 'id_empresa', '9'])
            ->andwhere(['like','codigo_caso',$proceso])
            ->andWhere(['like','codigo_caso',$division])
            ->count();
        return $count;
    }
    public function getHHEEII($mes)
    {
        $proceso='MD';
        if(Yii::$app->user->identity->id_proceso == 1)
            $proceso='MD';
        if(Yii::$app->user->identity->id_proceso == 2)
            $proceso='MC';
        if(Yii::$app->user->identity->id_proceso == 3)
            $proceso='SFT';

        $division ='Junin';
        if(Yii::$app->user->identity->id_division == 1)
            $division='Junin';
        if(Yii::$app->user->identity->id_division == 2)
            $division='Ayacucho';
        if(Yii::$app->user->identity->id_division == 3)
            $division='Carabobo';
        if(Yii::$app->user->identity->id_division == 4)
            $division='Boyaca';

        $anio=date('Y');
        //$sql = "SELECT COUNT(*) FROM actividad WHERE id_organizacion = 1 AND fecha_requerimiento =>".$anio."-".$mes."-01 AND fecha_requerimiento <=".$anio."-".$mes."-31";
        //$count = Yii::$app->db->createCommand($sql)->queryScalar();
        if($mes==1)
            $desde = ($anio-1).'-'.'12'.'-25';
        else
            $desde = $anio.'-'.($mes-1).'-25';
        $hasta = $anio.'-'.$mes.'-24';
        $count = $this::find()
            ->andwhere(['>=', 'fecha_requerimiento', $desde])
            ->andwhere(['<=', 'fecha_requerimiento', $hasta])
            ->andwhere(['=', 'id_organizacion', '1'])
            ->andwhere(['like','codigo_caso',$proceso])
            ->andWhere(['like','codigo_caso',$division])
            ->sum('HH');
        return number_format($count,2);
    }

    public function getHHDY($mes)
    {
        $proceso='MD';
        if(Yii::$app->user->identity->id_proceso == 1)
            $proceso='MD';
        if(Yii::$app->user->identity->id_proceso == 2)
            $proceso='MC';
        if(Yii::$app->user->identity->id_proceso == 3)
            $proceso='SFT';

        $division ='Junin';
        if(Yii::$app->user->identity->id_division == 1)
            $division='Junin';
        if(Yii::$app->user->identity->id_division == 2)
            $division='Ayacucho';
        if(Yii::$app->user->identity->id_division == 3)
            $division='Carabobo';
        if(Yii::$app->user->identity->id_division == 4)
            $division='Boyaca';
        $anio=date('Y');
        //$sql = "SELECT COUNT(*) FROM actividad WHERE id_organizacion = 2";
        //$count = Yii::$app->db->createCommand($sql)->queryScalar();
        if($mes==1)
            $desde = ($anio-1).'-'.'12'.'-25';
        else
            $desde = $anio.'-'.($mes-1).'-25';
        $hasta = $anio.'-'.$mes.'-24';
        $count = $this::find()
            ->andwhere(['>=', 'fecha_requerimiento', $desde])
            ->andwhere(['<=', 'fecha_requerimiento', $hasta])
            ->andwhere(['=', 'id_organizacion', '2'])
            ->andwhere(['like','codigo_caso',$proceso])
            ->andWhere(['like','codigo_caso',$division])
            ->sum('HH');
        return number_format($count,2);
    }
    public function getHHOP($mes)
    {
        $proceso='MD';
        if(Yii::$app->user->identity->id_proceso == 1)
            $proceso='MD';
        if(Yii::$app->user->identity->id_proceso == 2)
            $proceso='MC';
        if(Yii::$app->user->identity->id_proceso == 3)
            $proceso='SFT';

        $division ='Junin';
        if(Yii::$app->user->identity->id_division == 1)
            $division='Junin';
        if(Yii::$app->user->identity->id_division == 2)
            $division='Ayacucho';
        if(Yii::$app->user->identity->id_division == 3)
            $division='Carabobo';
        if(Yii::$app->user->identity->id_division == 4)
            $division='Boyaca';
        $anio=date('Y');
        //$sql = "SELECT COUNT(*) FROM actividad WHERE id_organizacion = 3";
        //$count = Yii::$app->db->createCommand($sql)->queryScalar();
        if($mes==1)
            $desde = ($anio-1).'-'.'12'.'-25';
        else
            $desde = $anio.'-'.($mes-1).'-25';
        $hasta = $anio.'-'.$mes.'-24';
        $count = $this::find()
            ->andwhere(['>=', 'fecha_requerimiento', $desde])
            ->andwhere(['<=', 'fecha_requerimiento', $hasta])
            ->andwhere(['=', 'id_organizacion', '3'])
            ->andwhere(['like','codigo_caso',$proceso])
            ->andWhere(['like','codigo_caso',$division])
            ->sum('HH');
        return number_format($count,2);
    }
    public function getHHCMP($mes)
    {
        $proceso='MD';
        if(Yii::$app->user->identity->id_proceso == 1)
            $proceso='MD';
        if(Yii::$app->user->identity->id_proceso == 2)
            $proceso='MC';
        if(Yii::$app->user->identity->id_proceso == 3)
            $proceso='SFT';

        $division ='Junin';
        if(Yii::$app->user->identity->id_division == 1)
            $division='Junin';
        if(Yii::$app->user->identity->id_division == 2)
            $division='Ayacucho';
        if(Yii::$app->user->identity->id_division == 3)
            $division='Carabobo';
        if(Yii::$app->user->identity->id_division == 4)
            $division='Boyaca';
        $anio=date('Y');
        $sql = "SELECT COUNT(*) FROM actividad WHERE id_organizacion = 4";
        $count = Yii::$app->db->createCommand($sql)->queryScalar();
        if($mes==1)
            $desde = ($anio-1).'-'.'12'.'-25';
        else
            $desde = $anio.'-'.($mes-1).'-25';
        $hasta = $anio.'-'.$mes.'-24';
        $count = $this::find()
            ->andwhere(['>=', 'fecha_requerimiento', $desde])
            ->andwhere(['<=', 'fecha_requerimiento', $hasta])
            ->andwhere(['=', 'id_organizacion', '4'])
            ->andwhere(['like','codigo_caso',$proceso])
            ->andWhere(['like','codigo_caso',$division])
            ->sum('HH');
        return number_format($count,2);
    }
    public function getHHOOGG($mes)
    {
        $proceso='MD';
        if(Yii::$app->user->identity->id_proceso == 1)
            $proceso='MD';
        if(Yii::$app->user->identity->id_proceso == 2)
            $proceso='MC';
        if(Yii::$app->user->identity->id_proceso == 3)
            $proceso='SFT';

        $division ='Junin';
        if(Yii::$app->user->identity->id_division == 1)
            $division='Junin';
        if(Yii::$app->user->identity->id_division == 2)
            $division='Ayacucho';
        if(Yii::$app->user->identity->id_division == 3)
            $division='Carabobo';
        if(Yii::$app->user->identity->id_division == 4)
            $division='Boyaca';
        $anio=date('Y');
        $sql = "SELECT COUNT(*) FROM actividad WHERE id_organizacion = 6 OR id_organizacion = 5";
        $count = Yii::$app->db->createCommand($sql)->queryScalar();
        if($mes==1)
            $desde = ($anio-1).'-'.'12'.'-25';
        else
            $desde = $anio.'-'.($mes-1).'-25';
        $hasta = $anio.'-'.$mes.'-24';
        $count = $this::find()
            ->andwhere(['>=', 'fecha_requerimiento', $desde])
            ->andwhere(['<=', 'fecha_requerimiento', $hasta])
            ->andwhere(['like','codigo_caso',$proceso])
            ->andWhere(['like','codigo_caso',$division])
            ->andwhere(['or','id_organizacion=6','id_organizacion=5'])
            ->sum('HH');
        return number_format($count,2);
    }
    public function getNumeroReal($mes)
    {
        $proceso='MD';
        if(Yii::$app->user->identity->id_proceso == 1)
            $proceso='MD';
        if(Yii::$app->user->identity->id_proceso == 2)
            $proceso='MC';
        if(Yii::$app->user->identity->id_proceso == 3)
            $proceso='SFT';

        $division ='Faja';
        if(Yii::$app->user->identity->id_division == 1)
            $division='Junin';
        if(Yii::$app->user->identity->id_division == 2)
            $division='Ayacucho';
        if(Yii::$app->user->identity->id_division == 3)
            $division='Carabobo';
        if(Yii::$app->user->identity->id_division == 4)
            $division='Boyaca';

        $anio=date('Y');
        //$sql = "SELECT COUNT(*) FROM actividad WHERE id_organizacion = 1 AND fecha_requerimiento =>".$anio."-".$mes."-01 AND fecha_requerimiento <=".$anio."-".$mes."-31";
        //$count = Yii::$app->db->createCommand($sql)->queryScalar();
        if($mes==1)
            $desde = ($anio-1).'-'.'12'.'-25';
        else
            $desde = $anio.'-'.($mes-1).'-25';
        $hasta = $anio.'-'.$mes.'-24';
        $count = $this::find()
            ->andwhere(['>=', 'fecha_requerimiento', $desde])
            ->andwhere(['<=', 'fecha_requerimiento', $hasta])
            ->andwhere(['like','codigo_caso',$proceso])
            ->andWhere(['like','codigo_caso',$division])
            ->count();
        return $count;
    }
    public function getNumeroPlan($mes)
    {
        $anio=date('Y');
        $datos = Plan::find()
            ->andwhere(['=', 'mes', $mes])
            ->andwhere(['=', 'anio', $anio])
            ->andwhere(['=','id_proceso',Yii::$app->user->identity->id_proceso])
            ->andwhere(['=','id_division',Yii::$app->user->identity->id_division])
            ->asArray()
            ->one();
        return $datos['cantidad'];
    }
}
