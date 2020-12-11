<?php

namespace frontend\models\search;

use frontend\models\Organizacion;
use frontend\models\User;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Estadistica;
use yii\helpers\ArrayHelper;

/**
 * EstadisticaSearch represents the model behind the search form about `frontend\models\Estadistica`.
 */
class EstadisticaSearch extends Estadistica
{
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
        $query = Estadistica::find();

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
        $query->joinWith(['idAnalista' => function ($q) {
            $q->where('user.id_proceso = "' . Yii::$app->user->identity->id_proceso . '"' //.
                      //'and user.status = 10'
            );
        }]);
        /*$query->andFilterWhere([
            //'user.id_division' => Yii::$app->user->identity->id_division,
            'user.id_proceso' => Yii::$app->user->identity->id_proceso,
            'user.status' => 10,
        ]);*/
        $query->andFilterWhere([
            'id_actividad' => $this->id_actividad,
            'id_subproceso' => $this->id_subproceso,
            'id_usuario' => $this->id_usuario,
            'id_via' => $this->id_via,
            'id_bd' => $this->id_bd,
            'id_organizacion' => $this->id_organizacion,
            'id_empresa' => $this->id_empresa,
            'id_proyecto' => $this->id_proyecto,
            'id_dato_cargado' => $this->id_dato_cargado,
            'id_macro' => $this->id_macro,
            'id_detallada' => $this->id_detallada,
            'fecha_requerimiento' => $this->fecha_requerimiento,
            'hora_requerimiento' => $this->hora_requerimiento,
            'fecha_atencion' => $this->fecha_atencion,
            'hora_ini' => $this->hora_ini,
            'hora_fin' => $this->hora_fin,
            'HH' => $this->HH,
            'id_status' => $this->id_status,
            'user.id_proceso' => Yii::$app->user->identity->id_proceso,
            'user.status' => 10,
        ]);

        $query->andFilterWhere(['like', 'codigo_caso', $this->codigo_caso])
            ->andFilterWhere(['like', 'id_analista', $this->id_analista])
            ->andFilterWhere(['like', 'detalle', $this->detalle]);
        /*$query->joinWith(['idAnalista' => function ($q) {
            $q->where('user.id_proceso = "' . Yii::$app->user->identity->id_proceso . '"' .
                      'and user.status = 10');
        }]);*/
        return $dataProvider;
    }
    /*
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
    public function getCantidadCursos($id_trabajador){
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
                ->andWhere(['id_analista'=> $id_trabajador])
                ->andwhere(['>=', 'fecha_requerimiento', $desde])
                ->andwhere(['<=', 'fecha_requerimiento', $hasta])
                ->count();
            $cantidadCursos[$i]=$count+0;
        }

        return $cantidadCursos;
    }
    public function getCantidadHH($id_trabajador){
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
                ->andWhere(['id_analista'=> $id_trabajador])
                ->andwhere(['>=', 'fecha_requerimiento', $desde])
                ->andwhere(['<=', 'fecha_requerimiento', $hasta])
                ->sum('HH');
            $cantidadCursos[$i]=$count+0;
        }

        return $cantidadCursos;
    }

    public function getCantidadCursosColumnas($id_trabajador,$trabajador){
        $j=2;
        $i=0;
        $cantidadCursos[$i]=['trabajador'=>$trabajador];
        for ($i = 1; $i <= 3; $i++) {
            $desde = (date('Y') - $j) . '-01-01';
            $hasta = (date('Y') - ($j)) . '12-31';
            $count = $this::find()
                ->andWhere(['id_trabajador' => $id_trabajador])
                ->andWhere(['>=', 'desde', $desde])
                ->andWhere(['<=', 'desde', $hasta])
                ->count();
            $cantidadCursos[$i] = [(date('Y') - $j)=>($count + 0)];
            $j--;
        }
        return $cantidadCursos;
    }
    public function getDivisiones(){
        $datos = Division::find()
            ->asArray()
            ->all();
        return ArrayHelper::map($datos,'id','nombre');
    }
    public function getDivisionNombre($i){
        $datos = Division::find()
            ->asArray()
            ->andWhere(['id'=>$i])
            ->one();
        return ArrayHelper::getValue($datos,'nombre');
    }*/
}
