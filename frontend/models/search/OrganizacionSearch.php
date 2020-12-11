<?php

namespace frontend\models\search;

use frontend\models\Actividad;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Organizacion;
use yii\helpers\ArrayHelper;

/**
 * OrganizacionSearch represents the model behind the search form about `frontend\models\Organizacion`.
 */
class OrganizacionSearch extends Organizacion
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['nombre'], 'safe'],
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
        $query = Organizacion::find();

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
        ]);

        $query->andFilterWhere(['like', 'nombre', $this->nombre]);

        return $dataProvider;
    }
    public function getOrganizaciones()
    {
        $datos = $this::find()
            ->asArray()
            ->all();
        return ArrayHelper::map($datos, 'id', 'nombre');
    }
    public function getOrganizacionesId(){
        $datos = $this::find()
            ->asArray()
            ->all();
        return ArrayHelper::map($datos,'id','id');
    }
    public function getOrganizacionesNombres(){
        $datos = $this::find()
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
            $count = Actividad::find()
                ->andWhere(['actividad.id_organizacion'=> $id_organizacion])
                ->andwhere(['>=', 'fecha_requerimiento', $desde])
                ->andwhere(['<=', 'fecha_requerimiento', $hasta])
                ->count();
            $cantidadServicios[$i]=$count+0;
        }

        return $cantidadServicios;
    }
    public function getCantidadServiciosHH($id_organizacion){
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
                ->andWhere(['actividad.id_organizacion'=> $id_organizacion])
                ->andwhere(['>=', 'fecha_requerimiento', $desde])
                ->andwhere(['<=', 'fecha_requerimiento', $hasta])
                ->sum('HH');
            $cantidadServiciosHH[$i]=$count+0;
        }

        return $cantidadServiciosHH;
    }
}
