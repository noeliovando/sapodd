<?php

namespace frontend\models;

use yii\helpers\ArrayHelper;

use Yii;

/**
 * This is the model class for table "user".
 * @return \yii\db\ActiveRelation
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
 * @property integer $id_supervisor
 * @property string $nombre
 * @property string $apellido
 * @property string $cedula
 * @property string $telefono
 * @property integer $id_organizacion
 * @property integer $id_distrito
 * @property integer $id_division
 * @property integer $id_aplicacion
 * @property string $nombreCompleto
 * @property AplicacionUsuario[] $aplicacionUsuarios
 * @property AplicacionesDb[] $idAplicacions
 */
class User extends \yii\db\ActiveRecord
{

    public $password;
    public $password_repeat;
    public $aplicaciones;
   // public $nombreCompleto;
    /**
     * @inheritdoc
     */
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

                ['aplicaciones', 'safe'],

                ['nombreCompleto','safe']
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

    public function actualizar()
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
            ->innerJoinWith('usuarioAplicacion') // Relation name
            ->where(['id_usuario' => $this->id])
            ->orderBy(['aplicaciones_db.nombre' => SORT_ASC])
            ->all();
    }

    public function getAplicacionesPermitidasList()
    {
        return $this->getAplicacionesPermitidas()->asArray();
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
    public function getNumeroServiciosTrabajador($id_trabajador,$mes)
    {
        $anio=date('Y');
        if($mes==1)
            $desde = ($anio-1).'-'.'12'.'-25';
        else
            $desde = $anio.'-'.($mes-1).'-25';
        $hasta = $anio.'-'.$mes.'-24';
        $count = Reporte::find()
            ->joinWith('idAnalista')
            ->andwhere(['id_analista'=> $id_trabajador])
            ->andwhere(['>=', 'fecha_requerimiento', $desde])
            ->andwhere(['<=', 'fecha_requerimiento', $hasta])
            ->andWhere(['user.status' => 10,
                'user.id_proceso' => Yii::$app->user->identity->id_proceso,])
            ->count();
        //echo '<pre>'; print_r($count); echo '</pre>';
        return $count;
        //$sql = "SELECT COUNT(*) id_macro FROM actividad WHERE id_macro =".$id_macro;
        //$count = Yii::$app->db->createCommand($sql)->queryScalar();
        //return $count;
    }
    public function getNumeroServiciosTrabajadorHH($id_trabajador,$mes)
    {
        $anio=date('Y');
        if($mes==1)
            $desde = ($anio-1).'-'.'12'.'-25';
        else
            $desde = $anio.'-'.($mes-1).'-25';
        $hasta = $anio.'-'.$mes.'-24';
        $count = Reporte::find()
            ->joinWith('idAnalista')
            ->andwhere(['id_analista'=> $id_trabajador])
            ->andwhere(['>=', 'fecha_requerimiento', $desde])
            ->andwhere(['<=', 'fecha_requerimiento', $hasta])
            ->andWhere(['user.status' => 10,
                'user.id_proceso' => Yii::$app->user->identity->id_proceso,])
            ->sum('HH');
        //echo '<pre>'; print_r($count); echo '</pre>';
        return $count? Yii::$app->formatter->asDecimal($count,0): '0';
        //$sql = "SELECT COUNT(*) id_macro FROM actividad WHERE id_macro =".$id_macro;
        //$count = Yii::$app->db->createCommand($sql)->queryScalar();
        //return $count;
    }

}
