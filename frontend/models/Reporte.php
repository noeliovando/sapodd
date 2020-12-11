<?php

namespace frontend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "actividad".
 *
 * @property integer $id_actividad
 * @property string $codigo_caso
 * @property string $id_analista
 * @property integer $id_subproceso
 * @property integer $id_usuario
 * @property integer $id_via
 * @property integer $id_bd
 * @property integer $id_organizacion
 * @property integer $id_empresa
 * @property integer $id_proyecto
 * @property integer $id_proy_ep
 * @property integer $id_dato_cargado
 * @property integer $ndlis
 * @property integer $nlis
 * @property integer $nlas
 * @property integer $ntiff
 * @property integer $npdf
 * @property integer $npds
 * @property integer $id_anio_pozo
 * @property integer $id_macro
 * @property integer $id_detallada
 * @property string $fecha_requerimiento
 * @property string $hora_requerimiento
 * @property string $fecha_ini_aten
 * @property string $hora_ini
 * @property string $fecha_fin_aten
 * @property string $hora_fin
 * @property double $HH
 * @property integer $id_status
 * @property string $detalle
 * @property string $pozo
 */
class Reporte extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'actividad';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['codigo_caso', 'id_analista', 'id_subproceso', 'id_usuario', 'id_via', 'id_bd', 'id_organizacion', 'id_empresa', 'id_proyecto', 'id_dato_cargado', 'id_macro', 'id_detallada', 'fecha_requerimiento', 'hora_requerimiento', 'fecha_atencion', 'hora_ini', 'hora_fin', 'HH', 'id_status', 'detalle'], 'required'],
            [['id_subproceso', 'id_usuario', 'id_via', 'id_bd', 'id_organizacion', 'id_empresa', 'id_proyecto', 'id_dato_cargado', 'id_macro', 'id_detallada', 'id_status'], 'integer'],
            [['fecha_requerimiento', 'hora_requerimiento', 'fecha_atencion', 'hora_ini', 'hora_fin'], 'safe'],
            [['HH'], 'number'],
            [['detalle'], 'string'],
            [['codigo_caso'], 'string', 'max' => 25],
            [['id_analista'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_actividad' => 'Id Actividad',
            'codigo_caso' => 'Codigo Caso',
            'id_analista' => 'Id Analista',
            'id_subproceso' => 'Id Subproceso',
            'id_usuario' => 'Id Usuario',
            'id_via' => 'Id Via',
            'id_bd' => 'Id Bd',
            'id_organizacion' => 'Id Organizacion',
            'id_empresa' => 'Id Empresa',
            'id_proyecto' => 'Id Proyecto',
            'id_dato_cargado' => 'Id Dato Cargado',
            'id_anio_pozo' => 'Id Anio Pozo',
            'id_macro' => 'Id Macro',
            'id_detallada' => 'Id Detallada',
            'fecha_requerimiento' => 'Fecha Requerimiento',
            'hora_requerimiento' => 'Hora Requerimiento',
            'fecha_atencion' => 'Fecha Atencion',
            'hora_ini' => 'Hora Ini',
            'hora_fin' => 'Hora Fin',
            'HH' => 'Hh',
            'id_status' => 'Id Status',
            'detalle' => 'Detalle',
        ];
    }

    public function getNumeroEEII()
    {
        $sql = "SELECT COUNT(*) FROM actividad WHERE id_organizacion = 1";
        $count = Yii::$app->db->createCommand($sql)->queryScalar();
        return $count;
    }
    public function getNumeroActividades($id_detallada,$mes)
    {
        $anio=date('Y');
        if($mes==1)
            $desde = ($anio-1).'-'.'12'.'-25';
        else
            $desde = $anio.'-'.($mes-1).'-25';
        $hasta = $anio.'-'.$mes.'-24';
        $count = Reporte::find()
            ->joinWith('idAnalista')
            ->andwhere(['id_detallada'=> $id_detallada])
            ->andwhere(['>=', 'fecha_requerimiento', $desde])
            ->andwhere(['<=', 'fecha_requerimiento', $hasta])
            ->andWhere(['user.id_division' => Yii::$app->user->identity->id_division,
                'user.id_proceso' => Yii::$app->user->identity->id_proceso,])
            ->count();
        return $count;
        //$sql = "SELECT COUNT(*) id_macro FROM actividad WHERE id_macro =".$id_macro;
        //$count = Yii::$app->db->createCommand($sql)->queryScalar();
        //return $count;
    }
    public function getHorasActividades($id_detallada,$mes)
    {
        $anio=date('Y');
        if($mes==1)
            $desde = ($anio-1).'-'.'12'.'-25';
        else
            $desde = $anio.'-'.($mes-1).'-25';
        $hasta = $anio.'-'.$mes.'-24';
        $count = Reporte::find()
            ->joinWith('idAnalista')
            ->andwhere(['id_detallada'=> $id_detallada])
            ->andwhere(['>=', 'fecha_requerimiento', $desde])
            ->andwhere(['<=', 'fecha_requerimiento', $hasta])
            ->andWhere(['user.id_division' => Yii::$app->user->identity->id_division,
                'user.id_proceso' => Yii::$app->user->identity->id_proceso,])
            ->sum('HH');
        return $count? Yii::$app->formatter->asDecimal($count,2): '0';
    }
    public function getIdDetallada()
    {
        return $this->hasOne(ActividadDetallada::className(), ['id' => 'id_detallada']);
    }
    public function getDetalladaNombre()
    {
        return $this->idDetallada? $this->idDetallada->nombre: 'Vacio';
    }
    public function getActividadesDetallada()
    {
        return ArrayHelper::map(ActividadDetallada::find()->asArray()->all(), 'id', 'nombre');
    }
    public function getActividadDetallada()
    {
        $datos = ActividadDetallada::find()->asArray()->all();
        return ArrayHelper::map($datos, 'id', 'nombre');
    }
    public function getIdMacro()
    {
        return $this->hasOne(ActividadMacro::className(), ['id' => 'id_macro']);
    }
    public function getMacroNombre()
    {
        return $this->idMacro? $this->idMacro->nombre: 'Vacio';
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
    public function getIdAnalista()
    {
        return $this->hasOne(User::className(), ['id' => 'id_analista']);
    }
    public function getIdProyecto()
    {
        return $this->hasOne(Proyecto::className(), ['id' => 'id_proyecto']);
    }
    public function getProyectoNombre()
    {
        return $this->idProyecto? $this->idProyecto->nombre: 'Vacio';
    }
    public function getProyecto()
    {
        $datos = Proyecto::find()->asArray()->all();
        return ArrayHelper::map($datos, 'id', 'nombre');
    }
    public function getNumeroProyecto($id_proyecto,$mes)
    {
        $anio=date('Y');
        if($mes==1)
            $desde = ($anio-1).'-'.'12'.'-25';
        else
            $desde = $anio.'-'.($mes-1).'-25';
        $hasta = $anio.'-'.$mes.'-24';
        $count = Reporte::find()
            ->joinWith('idAnalista')
            ->andwhere(['id_detallada'=> $id_proyecto])
            ->andwhere(['>=', 'fecha_requerimiento', $desde])
            ->andwhere(['<=', 'fecha_requerimiento', $hasta])
            ->andWhere(['user.id_division' => Yii::$app->user->identity->id_division,
                'user.id_proceso' => Yii::$app->user->identity->id_proceso,])
            ->count();
        return $count;
        //$sql = "SELECT COUNT(*) id_macro FROM actividad WHERE id_macro =".$id_macro;
        //$count = Yii::$app->db->createCommand($sql)->queryScalar();
        //return $count;
    }
    public function getIdOrganizacion()
    {
        return $this->hasOne(Organizacion::className(), ['id' => 'id_organizacion']);
    }
    public function getOrganizacionNombre()
    {
        return $this->idOrganizacion? $this->idOrganizacion->nombre: 'Vacio';
    }
    public function getOrganizacion()
    {
        $datos = Organizacion::find()->asArray()->all();
        return ArrayHelper::map($datos, 'id', 'nombre');
    }
    public function getNumeroOrganizacion($id_detallada,$mes)
    {
        $anio=date('Y');
        if($mes==1)
            $desde = ($anio-1).'-'.'12'.'-25';
        else
            $desde = $anio.'-'.($mes-1).'-25';
        $hasta = $anio.'-'.$mes.'-24';
        $count = Reporte::find()
            ->joinWith('idAnalista')
            ->andwhere(['id_detallada'=> $id_detallada])
            ->andwhere(['>=', 'fecha_requerimiento', $desde])
            ->andwhere(['<=', 'fecha_requerimiento', $hasta])
            ->andWhere([//'user.id_division' => Yii::$app->user->identity->id_division,
                'user.id_proceso' => Yii::$app->user->identity->id_proceso,])
            ->count();
        return $count;
        //$sql = "SELECT COUNT(*) id_macro FROM actividad WHERE id_macro =".$id_macro;
        //$count = Yii::$app->db->createCommand($sql)->queryScalar();
        //return $count;
    }
    public function getHorasOrganizacion($id_organizacion,$mes)
    {
        $anio=date('Y');
        if($mes==1)
            $desde = ($anio-1).'-'.'12'.'-25';
        else
            $desde = $anio.'-'.($mes-1).'-25';
        $hasta = $anio.'-'.$mes.'-24';
        $count = Reporte::find()
            ->joinWith('idAnalista')
            ->andwhere(['actividad.id_organizacion'=> $id_organizacion])
            ->andwhere(['>=', 'fecha_requerimiento', $desde])
            ->andwhere(['<=', 'fecha_requerimiento', $hasta])
            ->andWhere([//'user.id_division' => Yii::$app->user->identity->id_division,
                'user.id_proceso' => Yii::$app->user->identity->id_proceso,])
            ->sum('HH');
        $count = number_format($count, 0, '.', '');
        return $count;
        //$sql = "SELECT COUNT(*) id_macro FROM actividad WHERE id_macro =".$id_macro;
        //$count = Yii::$app->db->createCommand($sql)->queryScalar();
        //return $count;
    }
}
