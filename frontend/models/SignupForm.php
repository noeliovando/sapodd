<?php
namespace frontend\models;

use common\models\User;
use yii\base\Model;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $division;
    public $cedula;
    public $supervisor;
    public $id_organizacion;
    public $departamento;
    public $id_division;
    public $nombre;
    public $apellido;
    public $id_empresa;
    public $id_aplicacion;
    public $id_distrito;
    public $password_repeat;
    public $telefono;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Este usuario ya existe.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Este correo ya existe.'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],
            ['password_repeat', 'compare', 'compareAttribute'=>'password', 'skipOnEmpty' => false, 'message'=>"Contraseña no coincide"],

            ['cedula', 'required'],
            ['cedula', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Este usuario ya existe.'],
            ['cedula', 'integer'],

            ['supervisor', 'required'],
            ['supervisor', 'string'],

            ['id_organizacion', 'required'],
            ['id_organizacion', 'integer'],

            ['id_division', 'required'],
            ['id_division', 'integer'],

            ['id_distrito', 'required'],
            ['id_distrito', 'integer'],

            ['nombre', 'required'],
            ['nombre', 'string'],

            ['departamento', 'required'],
            ['departamento', 'string'],

            ['telefono', 'required'],
            ['telefono', 'string'],

            ['id_aplicacion', 'required'],
            ['id_aplicacion', 'integer'],

            ['id_empresa', 'required'],
            ['id_empresa', 'integer'],

            ['apellido', 'required'],
            ['apellido', 'string']

        ];
    }

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
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */

    public function signup()
    {
        if ($this->validate()) {
            $user = new User();
            $user->nombre = $this->nombre;
            $user->apellido = $this->apellido;
            $user->username = $this->username;
            $user->email = $this->email;
            $user->cedula = $this->cedula;
            $user->supervisor = $this->supervisor;
            $user->id_division = $this->id_division;
            $user->id_organizacion = $this->id_organizacion;
            $user->id_empresa = $this->id_empresa;
            $user->departamento = $this->departamento;
            $user->id_aplicacion = $this->id_aplicacion;
            $user->id_distrito = $this->id_distrito;
            $user->telefono = $this->telefono;
            $user->setPassword($this->password);
            $user->generateAuthKey();
            if ($user->save()) {
                return $user;
            }
        }

        return null;
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
    public function getEmpresas()
    {
        $datos = Empresa::find()->asArray()->all();
        return ArrayHelper::map($datos, 'id', 'nombre');
    }
    public function getAplicaciones()
    {
        $datos = AplicacionesDb::find()->asArray()->all();
        return ArrayHelper::map($datos, 'id', 'nombre');
    }
    public function getDistritos()
    {
        $datos = Distrito::find()->asArray()->all();
        return ArrayHelper::map($datos, 'id', 'nombre');
    }

}
