<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "actividades_resaltantes".
 *
 * @property integer $id
 * @property string $descripcion
 * @property string $fecha
 * @property integer $id_analista
 * @property integer $nombrecompleto
 */
class ActividadesResaltantes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */

    public static function tableName()
    {
        return 'actividades_resaltantes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['descripcion', 'fecha'], 'required'],
            [['descripcion'], 'string'],
            [['fecha'], 'safe'],
            [['id_analista'], 'integer'],
            [['nombrecompleto'],'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'descripcion' => 'Descripcion',
            'fecha' => 'Fecha',
            'id_analista' => 'Id User',
        ];
    }
    public function getUser()
    {
        return $this->hasOne(User::className(),['id' =>'id_analista']);
    }
    public function getNombreCompleto()
    {
        return $this->user? $this->user->nombre.' '.$this->user->apellido: 'Vacio';
    }
}
