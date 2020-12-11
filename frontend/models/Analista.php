<?php

namespace frontend\models;

use common\models\User;
use yii\helpers\ArrayHelper;
use Yii;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $rol_id
 * @property string $supervisor
 * @property string $nombre
 * @property string $apellido
 * @property string $cedula
 * @property integer $id_organizacion
 * @property integer $id_empresa
 * @property integer $id_distrito
 * @property integer $id_division
 * @property integer $id_proceso
 * @property integer $id_suproceso
 * @property string $departamento
 * @property integer $id_aplicacion
 * @property string $gerencia
 * @property string $telefono
 * @property integer $id_supervisor
 *
 * @property AplicacionUsuario[] $aplicacionUsuarios
 * @property AplicacionesDb[] $idAplicacions
 */
class Analista extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $password;
    public $password_repeat;
    public $aplicaciones;
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required','message' => 'No puede estar en blanco.'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Este usuario ya existe.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required','message' => 'No puede estar en blanco.'],
            ['email', 'email'],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Este correo ya existe.'],

            ['password', 'required','message' => 'No puede estar en blanco.'],
            ['password', 'string', 'min' => 6],
            ['password_repeat', 'compare', 'compareAttribute'=>'password', 'skipOnEmpty' => false, 'message'=>"Contraseña no coincide"],

            ['cedula', 'required','message' => 'No puede estar en blanco.'],
            ['cedula', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Este usuario ya existe.'],
            ['cedula', 'integer'],

            ['supervisor', 'required','message' => 'No puede estar en blanco.'],
            ['supervisor', 'string'],

            ['id_organizacion', 'required','message' => 'No puede estar en blanco.'],
            ['id_organizacion', 'integer'],

            ['id_division', 'required','message' => 'No puede estar en blanco.'],
            ['id_division', 'integer'],

            ['id_distrito', 'required','message' => 'No puede estar en blanco.'],
            ['id_distrito', 'integer'],

            ['nombre', 'required','message' => 'No puede estar en blanco.'],
            ['nombre', 'string'],

            ['departamento', 'required','message' => 'No puede estar en blanco.'],
            ['departamento', 'string'],

            ['telefono', 'required','message' => 'No puede estar en blanco.'],
            ['telefono', 'string'],

            ['id_aplicacion', 'required','message' => 'No puede estar en blanco.'],
            ['id_aplicacion', 'integer'],

            ['id_empresa', 'required','message' => 'No puede estar en blanco.'],
            ['id_empresa', 'integer'],

            ['apellido', 'required','message' => 'No puede estar en blanco.'],
            ['apellido', 'string'],
            ['aplicaciones', 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'username' => 'Indicador',
            'email' => 'Correo PDVSA',
            'password' => 'Contraseña',
            'cedula' => 'Cedula',
            'telefono' => 'Celular/Extension',
            'supervisor' => 'Indicador de Supervisor',
            'id_organizacion' => 'Organizacion',
            'id_empresa' => 'Empresa',
            'id_division' => 'Division',
            'id_distrito' => 'Distrito',
            'nombre' => 'Nombre',
            'apellido' => 'Apellido',
            'departamento' => 'Departamento/Proceso',
            'id_aplicacion' => 'Aplicacion o Base de Datos en la que trabaja',
            'password_repeat' => 'Repita Contraseña',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdAplicacions()
    {
        return $this->hasMany(AplicacionesDb::className(), ['id' => 'id_aplicacion'])->viaTable('aplicacion_usuario', ['id_usuario' => 'id']);
    }
    public function getNombreCompleto()
    {
        return $this->nombre.' '.$this->apellido;
    }
    public function getRol()
    {
        return $this->hasOne(Rol::className(),['id' =>'rol_id']);
    }
    public function getOrganizacion()
    {
        return $this->hasOne(Organizacion::className(),['id' =>'id_organizacion']);
    }
    public function getAplicacion()
    {
        return $this->hasOne(AplicacionesDb::className(),['id' =>'id_aplicacion']);
    }
    public function getDivision()
    {
        return $this->hasOne(Division::className(),['id' =>'id_division']);
    }
    public function getDistrito()
    {
        return $this->hasOne(Distrito::className(),['id' =>'id_distrito']);
    }
    public function getEmpresa()
    {
        return $this->hasOne(Empresa::className(),['id' =>'id_empresa']);
    }
    public function getOrganizacionNombre()
    {
        return $this->organizacion? $this->organizacion->nombre: 'Vacio';
    }
    public function getAplicacionNombre()
    {
        return $this->aplicacion? $this->aplicacion->nombre: 'Vacio';
    }
    public function getDivisionNombre()
    {
        return $this->division? $this->division->nombre: 'Vacio';
    }
    public function getDistritoNombre()
    {
        return $this->distrito? $this->distrito->nombre: 'Vacio';
    }
    public function getEmpresaNombre()
    {
        return $this->empresa? $this->empresa->nombre: 'Vacio';
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
    public function getUsers()

    {
        return $this->hasMany(User::className(), ['rol_id' => 'id']);
    }

    public function afterSave($insert, $changedAttributes){
        \Yii::$app->db->createCommand()->delete('aplicacion_usuario', 'id_usuario = '.(int) $this->id)->execute();

        foreach ($this->aplicaciones as $id) {
            $usrapp = new AplicacionUsuario();
            $usrapp->id_usuario = $this->id;
            $usrapp->id_aplicacion = $id;
            $usrapp->save();
        }
    }
    public function modificarApp(){
        \Yii::$app->db->createCommand()->delete('aplicacion_usuario', 'id_usuario = '.(int) $this->id)->execute();

        foreach ($this->aplicaciones as $id) {
            $usrapp = new AplicacionUsuario();
            $usrapp->id_usuario = $this->id;
            $usrapp->id_aplicacion = $id;
            $usrapp->save();
        }
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

    public function getAplicacionesPermitidasList()
    {
        return $this->getAplicacionesPermitidas()->asArray();
    }
    public function setPassword()
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($this->password);
    }

    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }
}
