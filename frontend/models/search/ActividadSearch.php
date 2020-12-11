<?php

namespace frontend\models\search;

use frontend\models\ActividadDetallada;
use frontend\models\ActividadMacro;
use frontend\models\AplicacionesDb;
use frontend\models\Distrito;
use frontend\models\Empresa;
use frontend\models\Organizacion;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Actividad;
use frontend\models\User;
use yii\db\Query;
use yii\helpers\ArrayHelper;

/**
 * ActividadSearch represents the model behind the search form about `frontend\models\Actividad`.
 */

class ActividadSearch extends Actividad
{
    public $macroNombre;
    public $empresaNombre;
    public $analistaUsername;
    public $organizacionNombre;
    public $aplicacionNombre;
    public $detalladaNombre;
    /**
     * @inheritdoc
     */

    public function rules()
    {
        return [
            [['id_actividad', 'id_subproceso', 'id_usuario', 'id_via', 'id_bd', 'id_organizacion', 'id_empresa', 'id_proyecto', 'id_macro', 'id_detallada', 'id_status'], 'integer'],
            [['codigo_caso', 'id_analista', 'fecha_requerimiento', 'hora_requerimiento', 'fecha_atencion', 'hora_ini', 'hora_fin', 'detalle'], 'safe'],
            [['HH'], 'number'],
            [['macroNombre'], 'safe'],
            [['empresaNombre'], 'safe'],
            [['analistaUsername'], 'safe'],
            [['organizacionNombre'], 'safe'],
            [['aplicacionNombre'], 'safe'],
            [['detalladaNombre'], 'safe'],


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
     *
     */

    public function search($params)
    {
        $query = Actividad::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        if(Yii::$app->user->identity->rol_id=='3')
            $query->andFilterWhere([
                'actividad.id_actividad' => $this->id_actividad,
                'actividad.id_subproceso' => $this->id_subproceso,
                'actividad.id_analista' => Yii::$app->user->identity->id,
                'actividad.id_usuario' => $this->id_usuario,
                'actividad.id_via' => $this->id_via,
                'actividad.id_bd' => $this->id_bd,
                'actividad.id_organizacion' => $this->id_organizacion,
                'actividad.id_empresa' => $this->id_empresa,
                'actividad.id_proyecto' => $this->id_proyecto,
                'actividad.id_dato_cargado' => $this->id_dato_cargado,
                'actividad.id_macro' => $this->id_macro,
                'actividad.id_detallada' => $this->id_detallada,
                'actividad.fecha_requerimiento' => $this->fecha_requerimiento,
                'actividad.hora_requerimiento' => $this->hora_requerimiento,
                'actividad.fecha_atencion' => $this->fecha_atencion,
                'actividad.hora_ini' => $this->hora_ini,
                'actividad.hora_fin' => $this->hora_fin,
                'actividad.HH' => $this->HH,
                'actividad.id_status' => $this->id_status,
                'actividad.detalle' => $this->detalle,
                'user.id_division' => Yii::$app->user->identity->id_division,
                'user.id_proceso' => Yii::$app->user->identity->id_proceso,
            ])
                ->orderBy(['actividad.fecha_atencion' => SORT_DESC,'actividad.hora_ini' => SORT_DESC]);


        //$query->joinWith(['analistaid']);

        if(Yii::$app->user->identity->rol_id=='4') {
            $query->joinWith(['analistaid' => function ($q) {
                $q->where('user.supervisor LIKE "%' . Yii::$app->user->identity->username . '%"');
            }]);
            $query->andFilterWhere([
                'actividad.id_actividad' => $this->id_actividad,
                'actividad.id_subproceso' => $this->id_subproceso,
                'actividad.id_analista' => $this->id_analista,
                'actividad.id_usuario' => $this->id_usuario,
                'actividad.id_via' => $this->id_via,
                'actividad.id_bd' => $this->id_bd,
                'actividad.id_organizacion' => $this->id_organizacion,
                'actividad.id_empresa' => $this->id_empresa,
                'actividad.id_proyecto' => $this->id_proyecto,
                'actividad.id_dato_cargado' => $this->id_dato_cargado,
                'actividad.id_macro' => $this->id_macro,
                'actividad.id_detallada' => $this->id_detallada,
                'actividad.fecha_requerimiento' => $this->fecha_requerimiento,
                'actividad.hora_requerimiento' => $this->hora_requerimiento,
                'actividad.fecha_atencion' => $this->fecha_atencion,
                'actividad.hora_ini' => $this->hora_ini,
                'actividad.hora_fin' => $this->hora_fin,
                'actividad.HH' => $this->HH,
                'actividad.id_status' => $this->id_status,
                'user.id_division' => Yii::$app->user->identity->id_division,
                'user.id_proceso' => Yii::$app->user->identity->id_proceso,
            ])
                ->orderBy(['actividad.fecha_atencion' => SORT_DESC,'actividad.hora_ini' => SORT_DESC]);

        }
        $query->andFilterWhere(['like', 'codigo_caso', $this->codigo_caso]);
        //$query->andFilterWhere(['MONTH(`fecha_atencion`)' => $month]);

        $query->joinWith(['macro' => function ($q) {
            $q->where('actividad_macro.nombre LIKE "%' . $this->macroNombre . '%"');
        }]);
        $query->joinWith(['empresaid' => function ($q) {
            $q->where('empresa.nombre LIKE "%' . $this->empresaNombre . '%"');
        }]);
        $query->joinWith(['analistaid' => function ($q) {
            $q->where('user.username LIKE "%' . $this->analistaUsername . '%"');
        }]);
        $query->joinWith(['organizacionid' => function ($q) {
            $q->where('organizacion.nombre LIKE "%' . $this->organizacionNombre . '%"');
        }]);
        $query->joinWith(['aplicdbid' => function ($q) {
            $q->where('aplicaciones_db.nombre LIKE "%' . $this->aplicacionNombre . '%"');
        }]);
        $query->joinWith(['detalladaid' => function ($q) {
            $q->where('actividad_detallada.nombre LIKE "%' . $this->detalladaNombre . '%"');
        }]);
        $query->joinWith(['analistaid' => function ($q) {
            $q->where('user.id_division = "' . Yii::$app->user->identity->id_division . '"');
        }]);
        $query->joinWith(['analistaid' => function ($q) {
            $q->where('user.id_proceso = "' . Yii::$app->user->identity->id_proceso . '"');
        }]);
        return $dataProvider;
    }
    public function getMacroNombre()
    {
        return $this->macros? $this->macros->nombre: 'Vacio';
    }

    public function getMacros()
    {
        return $this->hasOne(ActividadMacro::className(),['id' =>'id_macro']);
    }

    public function getActividadesMacro()
    {
        return ArrayHelper::map(ActividadMacro::find()->asArray()->all(), 'id', 'nombre');
    }
    public function getActividadMacro()
    {
        $datos = ActividadMacro::find()->asArray()->all();
        return ArrayHelper::map($datos, 'id', 'nombre');
    }
    public function getEmpresa()
    {
        $datos = Empresa::find()->asArray()->all();
        return ArrayHelper::map($datos, 'id', 'nombre');
    }
    public function getAnalista()
    {
        $datos = User::find()->andwhere(['rol_id' =>'3' ])->andwhere('user.supervisor LIKE "%' . Yii::$app->user->identity->username . '%"')->all();
        return ArrayHelper::map($datos, 'id', 'username');
    }
    public function getOrganizacion()
    {
        $datos = Organizacion::find()->asArray()->all();
        return ArrayHelper::map($datos, 'id', 'nombre');
    }
    public function getDistrito()
    {
        $datos = Distrito::find()->asArray()->all();
        return ArrayHelper::map($datos, 'id', 'nombre');
    }
    public function getAplicacion()
    {
        $datos = AplicacionesDb::find()->asArray()->all();
        return ArrayHelper::map($datos, 'id', 'nombre');
    }
    public function getActividadDetallada()
    {
        $datos = ActividadDetallada::find()->asArray()->all();
        return ArrayHelper::map($datos, 'id', 'nombre');
    }
    public function getProyectoEpNombre()
    {
        return $this->getproyectoepid()->nombre;
    }

    public function getproyectoepid()
    {
        return $this->hasOne(ProyectoEp::className(),['id' =>'id_proy_ep']);
    }
    public static function getMonthList()
    {
        $month = (new Query())->select('DISTINCT MONTH(`fecha_atencion`) as months')->from('{{%actividad}}')->column();
        return array_combine($month, $month);
    }

}
