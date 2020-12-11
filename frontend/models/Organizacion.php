<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "organizacion".
 *
 * @property integer $id
 * @property string $nombre
 */
class Organizacion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'organizacion';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre'], 'required'],
            [['nombre'], 'string', 'max' => 200]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre' => 'Nombre',
        ];
    }
    public function getNumeroServiciosOrganizacion($id_organizacion,$mes)
    {
        $anio=date('Y');
        if($mes==1)
            $desde = ($anio-1).'-'.'12'.'-25';
        else
            $desde = $anio.'-'.($mes-1).'-25';
        $hasta = $anio.'-'.$mes.'-24';
        $count = Reporte::find()
            ->andwhere(['id_organizacion'=> $id_organizacion])
            ->andwhere(['>=', 'fecha_requerimiento', $desde])
            ->andwhere(['<=', 'fecha_requerimiento', $hasta])
            ->count();
        return $count;
    }
    public function getNumeroServiciosOrganizacionHH($id_organizacion,$mes)
    {
        $anio=date('Y');
        if($mes==1)
            $desde = ($anio-1).'-'.'12'.'-25';
        else
            $desde = $anio.'-'.($mes-1).'-25';
        $hasta = $anio.'-'.$mes.'-24';
        $count = Reporte::find()
            ->andwhere(['id_organizacion'=> $id_organizacion])
            ->andwhere(['>=', 'fecha_requerimiento', $desde])
            ->andwhere(['<=', 'fecha_requerimiento', $hasta])
            ->sum('HH');
        return $count? Yii::$app->formatter->asDecimal($count,0): '0';
    }

}
