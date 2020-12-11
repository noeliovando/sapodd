<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "plan".
 *
 * @property integer $id
 * @property string $mes
 * @property string $cantidad
 * @property string $anio
 * @property integer $id_proceso
 * @property integer $id_division
 *
 * @property Proceso $idProceso
 * @property Division $idDivision
 */
class Plan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'plan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['mes', 'cantidad', 'anio', 'id_proceso', 'id_division'], 'required'],
            [['id_proceso', 'id_division'], 'integer'],
            [['mes', 'cantidad', 'anio'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'mes' => 'Mes',
            'cantidad' => 'Cantidad',
            'anio' => 'Anio',
            'id_proceso' => 'Id Proceso',
            'id_division' => 'Id Division',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdProceso()
    {
        return $this->hasOne(Proceso::className(), ['id' => 'id_proceso']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdDivision()
    {
        return $this->hasOne(Division::className(), ['id' => 'id_division']);
    }
}
