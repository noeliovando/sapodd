<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "actividad_detallada".
 *
 * @property integer $id
 * @property string $nombre
 * @property integer $id_macro
 */
class ActividadDetallada extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'actividad_detallada';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre', 'id_macro'], 'required'],
            [['id_macro'], 'integer'],
            [['nombre'], 'string', 'max' => 500]
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
            'id_macro' => 'Id Macro',
        ];
    }
    public function actionLists($id) {
        $countPosts = ActividadDetallada::find()
            ->where(['id_macro' => $id])
            ->count();
        $posts = ActividadDetallada::find()
            ->where(['id_macro' => $id])
            ->orderBy('id DESC')
            ->all();
        if($countPosts>0) {
            foreach($posts as $post){
                echo "<option value='".$post->id."'>".$post->nombre."</option>";
            }
        }
        else{
            echo "<option>-</option>";
        }
    }
}
