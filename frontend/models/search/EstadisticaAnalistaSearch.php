<?php

namespace frontend\models\search;

use frontend\models\Actividad;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\User;
use yii\helpers\ArrayHelper;

/**
 * EstadisticaAnalistaSearch represents the model behind the search form about `frontend\models\User`.
 */
class EstadisticaAnalistaSearch extends User
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status', 'created_at', 'updated_at', 'rol_id', 'id_organizacion', 'id_empresa', 'id_distrito', 'id_division', 'id_proceso', 'id_suproceso', 'id_aplicacion', 'id_supervisor'], 'integer'],
            [['username', 'auth_key', 'password_hash', 'password_reset_token', 'email', 'supervisor', 'nombre', 'apellido', 'cedula', 'departamento', 'gerencia', 'telefono'], 'safe'],
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
        $query = User::find();

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
            'id' => $this->id,
            'status' => 10,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'rol_id' => $this->rol_id,
            'id_organizacion' => $this->id_organizacion,
            'id_empresa' => $this->id_empresa,
            'id_distrito' => $this->id_distrito,
            'id_division' => $this->id_division,
            'id_proceso' => Yii::$app->user->identity->id_proceso,
            'id_suproceso' => $this->id_suproceso,
            'id_aplicacion' => $this->id_aplicacion,
            'id_supervisor' => $this->id_supervisor,
        ]);

        $query->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'auth_key', $this->auth_key])
            ->andFilterWhere(['like', 'password_hash', $this->password_hash])
            ->andFilterWhere(['like', 'password_reset_token', $this->password_reset_token])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'supervisor', $this->supervisor])
            ->andFilterWhere(['like', 'nombre', $this->nombre])
            ->andFilterWhere(['like', 'apellido', $this->apellido])
            ->andFilterWhere(['like', 'cedula', $this->cedula])
            ->andFilterWhere(['like', 'departamento', $this->departamento])
            ->andFilterWhere(['like', 'gerencia', $this->gerencia])
            ->andFilterWhere(['like', 'telefono', $this->telefono]);

        return $dataProvider;
    }
    public function getTrabajadores()
    {
        $datos = $this::find()
            ->andwhere(['id_proceso'=> Yii::$app->user->identity->id_proceso])
            ->andwhere(['status'=> 10])
            ->asArray()
            ->all();
        return ArrayHelper::map($datos, 'id', 'nombre');
    }
    public function getTrabajoresId(){
        $datos = $this::find()
            ->asArray()
            ->andWhere(['id_proceso'=>'1'])
            ->andWhere(['rol_id'=> '3'])
            ->andWhere(['status'=>10])
            ->andWhere(['id_division'=> Yii::$app->user->identity->id_division])
            ->all();
        return ArrayHelper::map($datos,'id','id');
    }
    public function getTrabajoresNombres(){
        $datos = $this::find()
            ->asArray()
            ->andWhere(['id_proceso'=>'1'])
            ->andWhere(['status'=>10])
            ->andWhere(['rol_id'=> '3'])
            ->andWhere(['id_division'=> Yii::$app->user->identity->id_division])
            ->all();
        return ArrayHelper::map($datos,'id','username');
    }
    public function getCantidadServicios($id_trabajador){
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
            $count = Actividad::find()
                ->andWhere(['id_analista'=> $id_trabajador])
                ->andwhere(['>=', 'fecha_requerimiento', $desde])
                ->andwhere(['<=', 'fecha_requerimiento', $hasta])
                ->count();
            $cantidadServicios[$i]=$count+0;
        }

        return $cantidadServicios;
    }
    public function getCantidadServiciosHH($id_trabajador){
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
            $count = Actividad::find()
                ->andWhere(['id_analista'=> $id_trabajador])
                ->andwhere(['>=', 'fecha_requerimiento', $desde])
                ->andwhere(['<=', 'fecha_requerimiento', $hasta])
                ->sum('HH');
            $cantidadServiciosHH[$i]=$count+0;
        }

        return $cantidadServiciosHH;
    }
}
