<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "actividades_complementarias".
 *
 * @property integer $id
 * @property string $descripcion
 * @property string $fecha
 * @property integer $id_analista
 * @property integer $nombrecompleto
 * @property User $idAnalista
 */
class ActividadesComplementarias extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'actividades_complementarias';
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
            'id_analista' => 'Id Analista',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(),['id' =>'id_analista']);
    }
    public function getIdAnalista()
    {
        return $this->hasOne(User::className(), ['id' => 'id_analista']);
    }
    public function getNombreCompleto()
    {
        return $this->idAnalista? $this->idAnalista->nombre.' '.$this->idAnalista->apellido: 'Vacio';
    }
}
