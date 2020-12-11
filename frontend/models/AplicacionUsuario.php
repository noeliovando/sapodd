<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "aplicacion_usuario".
 *
 * @property integer $id_usuario
 * @property integer $id_aplicacion
 *
 * @property User $idUsuario
 * @property AplicacionesDb $idAplicacion
 */
class AplicacionUsuario extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'aplicacion_usuario';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_usuario', 'id_aplicacion'], 'required'],
            [['id_usuario', 'id_aplicacion'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_usuario' => 'Id Usuario',
            'id_aplicacion' => 'Id Aplicacion',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdUsuario()
    {
        return $this->hasOne(User::className(), ['id' => 'id_usuario']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdAplicacion()
    {
        return $this->hasOne(AplicacionesDb::className(), ['id' => 'id_aplicacion']);
    }
}
