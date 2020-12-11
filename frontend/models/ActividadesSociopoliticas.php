<?php

namespace frontend\models;


use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "actividades_sociopoliticas".
 *
 * @property integer $id
 * @property string $descripcion
 * @property string $fecha
 * @property integer $id_analista
 */
class ActividadesSociopoliticas extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'actividades_sociopoliticas';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['descripcion', 'fecha', 'id_analista'], 'required'],
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
            'id_analista' => 'Id Analista',
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
