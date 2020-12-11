<?php

namespace frontend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "usuarios".
 *
 * @property integer $id
 * @property string $cedula
 * @property string $nombre
 * @property string $apellido
 * @property string $indicador
 * @property string $correo
 * @property string $supervisor
 * @property integer $id_division
 * @property integer $id_organizacion
 * @property integer $id_empresa
 * @property string $departamento
 * @property integer $id_aplicacion
 * @property string $telefono
 */
class Usuarios extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'usuarios';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['indicador', 'filter', 'filter' => 'trim'],
            ['indicador', 'required', 'message' => 'No puede estar en blanco.'],
            ['indicador', 'unique', 'targetClass' => '\frontend\models\Usuarios', 'message' => 'Este usuario ya existe.'],
            ['indicador', 'string', 'min' => 2, 'max' => 255],

            ['correo', 'filter', 'filter' => 'trim'],
            ['correo', 'required', 'message' => 'No puede estar en blanco.'],
            ['correo', 'email'],
            ['correo', 'unique', 'targetClass' => '\frontend\models\Usuarios', 'message' => 'Este correo ya existe.'],

            ['cedula', 'required', 'message' => 'No puede estar en blanco.'],
            ['cedula', 'unique', 'targetClass' => '\frontend\models\Usuarios', 'message' => 'Este usuario ya existe.'],

            ['supervisor', 'required', 'message' => 'No puede estar en blanco.'],
            ['supervisor', 'string'],

            ['id_organizacion', 'required', 'message' => 'No puede estar en blanco.'],
            ['id_organizacion', 'integer'],

            ['id_division', 'required', 'message' => 'No puede estar en blanco.'],
            ['id_division', 'integer'],

            ['nombre', 'required', 'message' => 'No puede estar en blanco.'],
            ['nombre', 'string'],

            ['departamento', 'required', 'message' => 'No puede estar en blanco.'],
            ['departamento', 'string'],

            ['telefono', 'required', 'message' => 'No puede estar en blanco.'],
            ['telefono', 'string'],

            ['id_aplicacion', 'required', 'message' => 'No puede estar en blanco.'],
            ['id_aplicacion', 'integer'],

            ['id_empresa', 'required', 'message' => 'No puede estar en blanco.'],
            ['id_empresa', 'integer'],

            ['apellido', 'required', 'message' => 'No puede estar en blanco.'],
            ['apellido', 'string'],

            ['aplicaciones', 'safe'],

            ['nombreCompleto', 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'indicador' => 'Indicador',
            'correo' => 'Correo PDVSA',
            'password' => 'Contraseña',
            'cedula' => 'Cedula',
            'telefono' => 'Celular/Extension',
            'supervisor' => 'Indicador de Supervisor',
            'id_organizacion' => 'Organizacion',
            'id_empresa' => 'Empresa',
            'id_division' => 'Division',
            'nombre' => 'Nombre',
            'apellido' => 'Apellido',
            'departamento' => 'Departamento/Proceso',
            'id_aplicacion' => 'Aplicacion o Base de Datos en la que trabaja',
            'password_repeat' => 'Repita Contraseña',
        ];
    }

    public function getNombreCompleto()
    {
        return $this->nombre . ' ' . $this->apellido;
    }

    public function getRol()
    {
        return $this->hasOne(Rol::className(), ['id' => 'rol_id']);
    }

    public function getOrganizacion()
    {
        return $this->hasOne(Organizacion::className(), ['id' => 'id_organizacion']);
    }

    public function getAplicacion()
    {
        return $this->hasOne(AplicacionesDb::className(), ['id' => 'id_aplicacion']);
    }

    public function getDivision()
    {
        return $this->hasOne(Division::className(), ['id' => 'id_division']);
    }

    public function getEmpresa()
    {
        return $this->hasOne(Empresa::className(), ['id' => 'id_empresa']);
    }

    public function getOrganizacionNombre()
    {
        return $this->organizacion ? $this->organizacion->nombre : 'Vacio';
    }

    public function getAplicacionNombre()
    {
        return $this->aplicacion ? $this->aplicacion->nombre : 'Vacio';
    }

    public function getDivisionNombre()
    {
        return $this->division ? $this->division->nombre : 'Vacio';
    }

    public function getEmpresaNombre()
    {
        return $this->empresa ? $this->empresa->nombre : 'Vacio';
    }

    public function getOrganizaciones()
    {
        $datos = Organizacion::find()->asArray()->all();
        return ArrayHelper::map($datos, 'id', 'nombre');
    }

    public function getDivisiones()
    {
        $datos = Division::find()->asArray()->all();
        return ArrayHelper::map($datos, 'id', 'nombre');
    }

    public function getAplicaciones()
    {
        $datos = AplicacionesDb::find()->asArray()->all();
        return ArrayHelper::map($datos, 'id', 'nombre');
    }

    public function getEmpresas()
    {
        $datos = Empresa::find()->asArray()->all();
        return ArrayHelper::map($datos, 'id', 'nombre');
    }

    public function getDistritos()
    {
        $datos = Distrito::find()->asArray()->all();
        return ArrayHelper::map($datos, 'id', 'nombre');
    }

    public function actualizar()
    {
        if ($this->validate()) {
            $usuario = new Usuarios();
            $usuario->nombre = $this->nombre;
            $usuario->apellido = $this->apellido;
            $usuario->indicador = $this->indicador;
            $usuario->correo = $this->correo;
            $usuario->cedula = $this->cedula;
            $usuario->supervisor = $this->supervisor;
            $usuario->id_division = $this->id_division;
            $usuario->id_organizacion = $this->id_organizacion;
            $usuario->id_empresa = $this->id_empresa;
            $usuario->departamento = $this->departamento;
            $usuario->id_aplicacion = $this->id_aplicacion;
            $usuario->telefono = $this->telefono;
            $usuario->setPassword($this->password);
            $usuario->generateAuthKey();
            if ($usuario->save()) {
                return $usuario;
            }
        }

        return null;
    }

    public function setPassword()
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($this->password);
    }

    public function setPasswordHasch()
    {
        $this->password_hash = $this->password_hash;
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    public function getAplicacionUsuario()
    {
        return $this->hasMany(AplicacionUsuario::className(), ['id_usuario' => 'id']);
    }

    public function getAplicacionesPermitidas()
    {
        return $this->hasMany(AplicacionesDb::className(), ['id' => 'id_aplicacion'])
            ->viaTable('aplicacion_usuario', ['id_usuario' => 'id']);
    }

    public function getAplicacionesDb()
    {
        return AplicacionesDb::find()
            ->select(['aplicaciones_db.id', 'aplicaciones_db.nombre'])
            ->innerJoinWith('usuarioAplicacion')// Relation name
            ->where(['id_usuario' => $this->id])
            ->orderBy(['aplicaciones_db.nombre' => SORT_ASC])
            ->all();
    }

    public function getAplicacionesPermitidasList()
    {
        return $this->getAplicacionesPermitidas()->asArray();
    }

    public function afterSave($insert, $changedAttributes)
    {
        \Yii::$app->db->createCommand()->delete('aplicacion_usuario', 'id_usuario = ' . (int)$this->id)->execute();

        foreach ($this->aplicaciones as $id) {
            $usrapp = new AplicacionUsuario();
            $usrapp->id_usuario = $this->id;
            $usrapp->id_aplicacion = $id;
            $usrapp->save();
        }
    }

    public function getAppPermitidas($id_user)
    {
        return $this->hasMany(AplicacionesDb::className(), ['id' => 'id_aplicacion'])
            ->viaTable('aplicacion_usuario', ['id_usuario' => $id_user])
            ->asArray();
    }

    public function getAppPermitidasList($id_user)
    {
        return ArrayHelper::map($this->getAppPermitidas(Yii::$app->user->identity->id), 'id_aplicacion', 'nombre');
    }
    public function setNombre(){
        $this->nombre = strtoupper(substr($this->nombre,0,1)) .strtolower(substr($this->nombre,1));
    }
    public function setApellido(){
        $this->apellido = strtoupper(substr($this->apellido,0,1)) .strtolower(substr($this->apellido,1));
    }
    public function setIndicador(){
        $this->indicador = strtolower($this->indicador);
    }
    public function setCorreo(){
        $this->correo = strtolower($this->correo);
    }
    public function setSupervisor(){
        $this->supervisor = strtolower($this->supervisor);
    }
    public function setDepartamento(){
        $this->departamento = strtoupper(substr($this->departamento,0,1)) .strtolower(substr($this->departamento,1));
    }
}