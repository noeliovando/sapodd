<?php

namespace frontend\models;
use yii\helpers\ArrayHelper;

use Yii;
use yii\helpers\StringHelper;

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
 * @property string $fecha_atencion
 * @property string $hora_ini
 * @property string $hora_fin
 * @property double $HH
 * @property integer $id_status
 * @property string $detalle
 * @property integer $pozo
 */
class Actividad extends \yii\db\ActiveRecord
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
            [['codigo_caso', 'id_analista', 'id_subproceso', 'id_usuario', 'id_via', 'id_bd', 'id_organizacion', 'id_empresa', 'id_proyecto', 'id_dato_cargado', 'id_macro', 'id_detallada', 'fecha_requerimiento', 'hora_requerimiento', 'fecha_atencion', 'hora_ini', 'hora_fin', 'id_status', 'detalle'], 'required', 'message'=>'El campo no puede estar vacío'],
            [['id_subproceso', 'id_usuario', 'id_via', 'id_bd', 'id_organizacion', 'id_empresa', 'id_proyecto', 'id_dato_cargado', 'id_macro', 'id_detallada', 'id_status'], 'integer'],
            [['fecha_requerimiento', 'hora_requerimiento', 'fecha_atencion', 'hora_ini', 'hora_fin'], 'safe'],
            [['HH'], 'number'],
            [['detalle'], 'string'],
            [['codigo_caso'], 'string', 'max' => 25],
            [['id_macro','id_detallada'], 'safe'],
            [['id_analista'], 'string', 'max' => 20],
            [['fecha_atencion'], 'compare','compareAttribute'=>'fecha_requerimiento','operator'=>'>=','message'=>'Fecha de atencion debe ser mayor o igual que fecha de requerimiento'],
            ['hora_requerimiento','compare','compareValue'=>'16:30','operator'=>'<=','message'=>'Hora debe ser menor a 4:30 p.m.'],
            ['hora_ini','compare','compareValue'=>'16:30','operator'=>'<=','type'=>'number','message'=>'Hora debe ser menor a 4:30 p.m.'],
            ['hora_fin','compare','compareValue'=>'16:30','operator'=>'<=','type'=>'number','message'=>'Hora debe ser menor a 4:30 p.m.'],
            ['hora_requerimiento','compare','compareValue'=>'7:00','operator'=>'>=','type'=>'number','message'=>'Hora debe ser mayor a 7:00 a.m.'],
            ['hora_ini','compare','compareValue'=>'7:00','operator'=>'>=','type'=>'number','message'=>'Hora debe ser mayor a 7:00 a.m.'],
            ['hora_fin','compare','compareValue'=>'7:00','operator'=>'>=','type'=>'number','message'=>'Hora debe ser mayor a 7:00 a.m.'],
            [['hora_fin'], 'compare','compareAttribute'=>'hora_ini','operator'=>'>','message'=>'Hora fin debe ser mayor que hora de inicio'],
            //[['hora_ini'], ConditionalValidator::className(),
              //  'if' => [
                //    [['fecha_requerimiento'], 'compare','compareAttribute'=>'fecha_atencion','operator'=>'==']
                //],
                //'then' => [
                  //  [['hora_ini'], 'compare','compareAttribute'=>'hora_requerimiento','operator'=>'>=','message'=>'Hora inicio debe ser mayor o igual que hora de requerimiento '],
                //]
            //],
            //strtotime($this->fecha_atencion)>strtotime($this->fecha_requerimiento)?
              //  [['hora_fin'], 'compare','compareAttribute'=>'hora_ini','operator'=>'>','message'=>'Hora fin debe ser mayor que hora de inicio']:
            //    [['hora_ini'], 'compare','compareAttribute'=>'hora_requerimiento','operator'=>'>=','message'=>'Hora inicio debe ser mayor o igual que hora de requerimiento '],

        ];
    }

    /**
     * @inheritdoc
     */
    public function validar_fecha($attribute, $param){
        if(strtotime($this->fecha_atencion)==strtotime($this->fecha_requerimiento)){
            if($this->hora_requerimiento>$this->hora_ini)
                $this->addError($attribute, 'Hora inicio debe ser mayor o igual que hora de requerimiento');
        }
    }
    public function attributeLabels()
    {
        return [
            'id_actividad' => 'Id Actividad',
            'codigo_caso' => 'Codigo Caso',
            'id_analista' => 'Analista',
            'id_subproceso' => 'Subproceso',
            'id_usuario' => 'Usuario',
            'id_via' => 'Solicitud Via',
            'id_bd' => 'Base de Datos o Aplicacion',
            'id_organizacion' => 'Organizacion',
            'id_empresa' => 'Empresa',
            'id_proyecto' => 'Proyecto',
            'id_dato_cargado' => 'Dato Cargado',
            'id_macro' => 'Actividad Macro',
            'id_detallada' => 'Actividad Detallada',
            'fecha_requerimiento' => 'Fecha de Requerimiento',
            'hora_requerimiento' => 'Hora de Requerimiento',
            'fecha_atencion' => 'Fecha Atencion',
            'hora_ini' => 'Hora Inicio',
            'hora_fin' => 'Hora Fin',
            'HH' => 'HH',
            'id_status' => 'Estado',
            'detalle' => 'Detalle',
        ];
    }


    public function getActividadMacro()
    {
        $datos = ActividadMacro::find()->andWhere(['id_proceso'=>Yii::$app->user->identity->id_proceso])->asArray()->all();
        return ArrayHelper::map($datos, 'id', 'nombre');
    }

    public function getActividadDetallada()
    {
        $datos = ActividadDetallada::find()->asArray()->all();
        return ArrayHelper::map($datos, 'id', 'nombre');
    }

    public function getAnalista()
    {
        $datos = User::find()->where(['id' =>Yii::$app->user->identity->id ])->all();
        return ArrayHelper::map($datos, 'id', 'nombrecompleto');
    }

    public function getSubproceso()
    {
        $datos = Subproceso::find()->asArray()->andWhere(['id'=>Yii::$app->user->identity->id_suproceso])->all();
        return ArrayHelper::map($datos, 'id', 'nombre');
    }

    public function getUsuario()
    {
        $datos = Usuarios::find()
            /*->andWhere(['or',
                ['id_division'=>Yii::$app->user->identity->id_division],
                ['id_division'=>'5']
            ])*/
            ->orderBy(['indicador' => SORT_ASC])
            ->all();
        return ArrayHelper::map($datos, 'id', 'indicador');
    }

    public function getSolicitudVia()
    {
        $datos = SolicitudVia::find()->asArray()->all();
        return ArrayHelper::map($datos, 'id', 'nombre');
    }

    public function getAplicacionesDb()
    {
        $users = AplicacionUsuario::findOne(Yii::$app->user->identity->id);
        $datos = AplicacionesDb::find()->asArray()->all();

        return ArrayHelper::map($users->getIdAplicacion()->asArray()->all(),'id','nombre');
    }


    public function getDistrito()
    {
        $datos = Distrito::find()->asArray()->all();
        return ArrayHelper::map($datos, 'id', 'nombre');
    }

    public function getEmpresa()
    {
        $datos = Empresa::find()->andWhere(['or',
                ['id_division'=>Yii::$app->user->identity->id_division],
                ['id_division'=>'5']
            ])->asArray()->all();
        return ArrayHelper::map($datos, 'id', 'nombre');
    }

    public function getProyecto()
    {
        $datos = Proyecto::find()->asArray()->all();
        return ArrayHelper::map($datos, 'id', 'nombre');
    }

    public function getProyectoEp()
    {
        $datos = ProyectoEp::find()->asArray()->all();
        return ArrayHelper::map($datos, 'id', 'nombre');
    }

    public function getDatoCargado()
    {
        $datos = DatoCargado::find()->asArray()->all();
        return ArrayHelper::map($datos, 'id', 'nombre');
    }
    public function getOrganizacion()
    {
        $datos = Organizacion::find()->asArray()->all();
        return ArrayHelper::map($datos, 'id', 'nombre');
    }

    public function getAnio()
    {
        $datos = AnioPozo::find()->asArray()->orderBy(['nombre' => SORT_DESC])->all();
        return ArrayHelper::map($datos, 'id', 'nombre');
    }
    public function getStatus()
    {
        $datos = Status::find()->asArray()->all();
        return ArrayHelper::map($datos, 'id', 'nombre');
    }

    public function getCodigoActividad()
    {
        $user = User::find()
            ->where(['username' => Yii::$app->user->identity->username])
            ->asArray()
            ->one();

        $proceso = Proceso::find()
            ->where(['id' => ArrayHelper::getValue($user,'id_proceso')])
            ->one();

        $nombreAnalista = ArrayHelper::getValue($user,'nombre');
        $apellidoAnalista = ArrayHelper::getValue($user,'apellido');
        $division = Division::find()
            ->where(['id' => ArrayHelper::getValue($user,'id_division')])
            ->one();
        $divisionAnalista = ArrayHelper::getValue($division,'nombre');
        $procesoAnalista="0";
        if(ArrayHelper::getValue($proceso,'id')=='1')
            $procesoAnalista = "MD";
        elseif(ArrayHelper::getValue($proceso,'id')=='2')
            $procesoAnalista = "MC";
        else
            $procesoAnalista = "SFT";
        $actividad = Actividad::find()
            ->Where(['like','id_analista',Yii::$app->user->identity->id])
            ->orderBy(['id_actividad' => SORT_DESC])
        ->asArray()
        ->one();
        $fechaActual =$this->fecha_requerimiento;
        $anioAct=StringHelper::explode(date('Y/m/d'),'/')[0];
        $fechaUlt = ArrayHelper::getValue($actividad,'fecha_requerimiento');
        $anioUlt = StringHelper::explode($fechaUlt,'-')[0];
        if(!ArrayHelper::getValue($actividad,'codigo_caso')==''&& $anioAct==$anioUlt)
        $ultimaActividad = explode('-',ArrayHelper::getValue($actividad,'codigo_caso'))[3]+1;
        else
            $ultimaActividad=1;
        $codigoActividad = strtoupper($divisionAnalista)
            .'-'.$procesoAnalista
            .'-'.substr($nombreAnalista,0,1) .substr($apellidoAnalista,0,1)
            .'-'.($ultimaActividad);
        return $codigoActividad;
    }
    public function reajustarCodigos(){
        $user = User::find()
            ->where(['username' => Yii::$app->user->identity->username])
            ->asArray()
            ->one();

        $proceso = Proceso::find()
            ->where(['id' => ArrayHelper::getValue($user,'id_proceso')])
            ->one();

        $nombreAnalista = ArrayHelper::getValue($user,'nombre');
        $apellidoAnalista = ArrayHelper::getValue($user,'apellido');
        $division = Division::find()
            ->where(['id' => ArrayHelper::getValue($user,'id_division')])
            ->one();
        $divisionAnalista = ArrayHelper::getValue($division,'nombre');
        if(ArrayHelper::getValue($proceso,'id')=='1')
            $procesoAnalista = "MD";
        elseif(ArrayHelper::getValue($proceso,'id')=='2')
            $procesoAnalista = "MC";
        else
            $procesoAnalista = "SFT";
        $anioAct=StringHelper::explode(date('Y/m/d'),'/')[0];
        $query = Actividad::find()
            ->andWhere(['id_analista' => Yii::$app->user->identity->id])
            ->andWhere(['>=','fecha_atencion',$anioAct.'-01-01'])
            ->orderBy(['actividad.fecha_atencion' => SORT_ASC,'actividad.hora_ini' => SORT_ASC])
            ->asArray()
            ->all();
        $numeroActividad=1;
        $actividades = ArrayHelper::map($query,'id_actividad','id_actividad');
        //echo '<pre>'; print_r($actividades); echo '</pre>';
        foreach($actividades as $actividad){
            $actividad;
            $model=$this->findModel($actividad);
            $model->codigo_caso= $codigoActividad = strtoupper($divisionAnalista)
                .'-'.$procesoAnalista
                .'-'.substr($nombreAnalista,0,1) .substr($apellidoAnalista,0,1)
                .'-'.$numeroActividad++;
            $model->save();
        }
        return $actividades;
    }
    protected function findModel($id)
    {
        if (($model = Actividad::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('La pagina solicitada no existe.');
        }
    }
    public function getOrganizacionid()
    {
        return $this->hasOne(Organizacion::className(),['id' =>'id_organizacion']);
    }
    public function getViaid()
    {
        return $this->hasOne(SolicitudVia::className(),['id' =>'id_via']);
    }
    public function getUsuarioinfo()
    {
        return $this->hasOne(Usuarios::className(),['id' =>'id_usuario']);
    }
    public function getEmpresaid()
    {
        return $this->hasOne(Empresa::className(),['id' =>'id_empresa']);
    }
    public function getDivisionid()
    {
        return $this->hasOne(Division::className(),['id' =>'id_division']);
    }
    public function getProyectoid()
    {
        return $this->hasOne(Proyecto::className(),['id' =>'id_proyecto']);
    }
    public function getProyectoEpId()
    {
        return $this->hasOne(ProyectoEp::className(),['id' =>'id_proy_ep']);
    }
    public function getAnalistaid()
    {
        return $this->hasOne(User::className(),['id' =>'id_analista']);
    }
    public function getsubprocesoid()
    {
        return $this->hasOne(Subproceso::className(),['id' =>'id_subproceso']);
    }
    public function getaniopozoid()
    {
        return $this->hasOne(AnioPozo::className(),['id' =>'id_anio_pozo']);
    }
    public function getmacroid()
    {
        return $this->hasOne(ActividadMacro::className(),['id' =>'id_macro']);
    }
    public function getdetalladaid()
    {
        return $this->hasOne(ActividadDetallada::className(),['id' =>'id_detallada']);
    }
    public function getdatocargadoid()
    {
        return $this->hasOne(DatoCargado::className(),['id' =>'id_dato_cargado']);
    }
    public function getAplicdbid()
    {
        return $this->hasOne(AplicacionesDb::className(),['id' =>'id_bd']);
    }
    public function getStatusid()
    {
        return $this->hasOne(Status::className(),['id' =>'id_status']);
    }

    public function getReporteActividad()
    {
        $datos = ActividadDetallada::find()
            ->select(['COUNT(*) AS cnt'])
            ->where(['id_organizacion = 1'])
            ->asArray()->all();
        return $datos;
    }
    public function getSubprocesoNombre()
    {
        return $this->getsubprocesoid()->nombre;
    }
    public function getAnalistaNombre()
    {
        return $this->getanalistaid()->nombre;
    }
    public function getUsuarioNombre()
    {
        return $this->getUsuarioinfo()->nombre;
    }
    public function getProyectoEpNombre()
    {
        return $this->proyectoEpId->nombre;
    }

    public function getOrganizaciones()
    {
        return $this->hasOne(Organizacion::className(),['id' =>'id_organizacion']);
    }
    public function getOrganizacionNombre()
    {
        return $this->organizaciones? $this->organizaciones->nombre: 'Vacio';
    }

    public function setHorasHombre(){
        $horai=StringHelper::explode($this->hora_ini,':',true,false);
        $horaf=StringHelper::explode($this->hora_fin,':',true,false);

        if($horaf[0] == $horai[0]){
            $this->HH =($horaf[1] -$horai[1])/60;
        }
        else{

            $this->HH  = (60*($horaf[0]-$horai[0])-$horai[1]+$horaf[1])/60;
        }
    }
    public function setOrganizacion(){
        $this->id_organizacion = ArrayHelper::getValue(Usuarios::find()->andWhere(['id'=>$this->id_usuario])->asArray()->one(),'id_organizacion');
    }
    public function setEmpresa(){
        $this->id_empresa = ArrayHelper::getValue(Usuarios::find()->andWhere(['id'=>$this->id_usuario])->asArray()->one(),'id_empresa');
    }
    public function getMacro()
    {
        return $this->hasOne(ActividadMacro::className(),['id' =>'id_macro']);
    }
    public function getMacroNombre()
    {
        return $this->macro? $this->macro->nombre: 'Vacio';
    }
    public function getempresaNombre()
    {
        return $this->empresaid? $this->empresaid->nombre: 'Vacio';
    }

    public function getanalistaUsername()
    {
        return $this->analistaid? $this->analistaid->username: 'Vacio';
    }
    public function getaplicacionNombre()
    {
        return $this->aplicdbid? $this->aplicdbid->nombre: 'Vacio';
    }
    public function getDetallada()
    {
        return $this->hasOne(ActividadMacro::className(),['id' =>'id_macro']);
    }
    public function getDetalladaNombre()
    {
        return $this->detalladaid? $this->detalladaid->nombre: 'Vacio';
    }

}
?>