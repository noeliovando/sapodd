<?php

namespace frontend\models\search;

use frontend\models\Organizacion;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\ReporteOrganizacion;

/**
 * ReporteSearch represents the model behind the search form about `frontend\models\ReporteHoras`.
 */
class ReporteOrganizacionSearch extends ReporteOrganizacion
{
    public $mes;
    public $anio;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_actividad', 'id_subproceso', 'id_usuario', 'id_via', 'id_bd', 'id_organizacion', 'id_distrito', 'id_empresa', 'id_proyecto', 'id_proy_ep', 'id_dato_cargado', 'ndlis', 'nlis', 'nlas', 'ntiff', 'npdf', 'npds', 'id_anio_pozo', 'id_macro', 'id_detallada', 'id_status'], 'integer'],
            [['codigo_caso', 'id_analista', 'fecha_requerimiento', 'hora_requerimiento', 'fecha_atencion', 'hora_ini', 'hora_fin', 'detalle', 'pozo'], 'safe'],
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
        $desde = $anio.'-01-01';
        $hasta = $anio.'-12-31';
        //$query = Reporte::find();
        $query = ReporteOrganizacion::find()->joinWith('idMacro')->groupBy('{{actividad_macro}}.id');

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
            'id_organizacion' => $this->id_organizacion,
            '{{organizacion}}.id' => $this->id_organizacion,
        ]);
        $query->andFilterWhere([
            //'user.id_division' => Yii::$app->user->identity->id_division,
            //'user.id_proceso' => Yii::$app->user->identity->id_proceso,
        ]);

        $query->andFilterWhere(['like', 'codigo_caso', $this->codigo_caso])
            ->andFilterWhere(['like', 'id_analista', $this->id_analista])
            ->andFilterWhere(['like', 'detalle', $this->detalle])
            ->andFilterWhere(['like', 'pozo', $this->pozo])
            ->andFilterWhere(['>=', 'fecha_requerimiento', $desde])
            ->andFilterWhere(['<=', 'fecha_requerimiento', $hasta]);
                $query->joinWith(['idAnalista' => function ($q) {
                    $q->where('user.id_division = "' . Yii::$app->user->identity->id_division . '"');
                }]);

        return $dataProvider;
    }
    public function getIdOrganizacion()
    {
        return $this->hasOne(Organizacion::className(), ['id' => 'id_organizacion']);
    }
    public function getOrganizacionNombre()
    {
        return $this->idOrganizacion? $this->idOrganizacion->nombre: 'Vacio';
    }
    public function getIdMacro()
    {
        return $this->hasOne(ActividadMacro::className(), ['id' => 'id_macro']);
    }
}
