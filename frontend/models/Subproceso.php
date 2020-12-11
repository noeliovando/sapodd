<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "subproceso".
 *
 * @property integer $id
 * @property string $nombre
 * @property integer $id_proceso
 */
class Subproceso extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'subproceso';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre', 'id_proceso'], 'required'],
            [['id_proceso'], 'integer'],
            [['nombre'], 'string', 'max' => 25]
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
            'id_proceso' => 'Id Proceso',
        ];
    }
}
