<?php

namespace frontend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\ActividadesComplementarias;
use yii\helpers\ArrayHelper;
use frontend\models\User;

/**
 * ActividadesComplementariasSearch represents the model behind the search form about `frontend\models\ActividadesComplementarias`.
 */
class ActividadesComplementariasSearch extends ActividadesComplementarias
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_analista'], 'integer'],
            [['descripcion', 'fecha'], 'safe'],
            ['nombreCompleto','safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = ActividadesComplementarias::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        if(Yii::$app->user->identity->rol_id=='3')
            $query->andFilterWhere([
                'id' => $this->id,
                'fecha' => $this->fecha,
                'id_analista' => Yii::$app->user->identity->id,
            ])
                ->orderBy(['fecha' => SORT_DESC]);
        if (Yii::$app->user->identity->rol_id == '4') {
            $query->joinWith(['user' => function ($q) {
                $q->where('supervisor LIKE "%' . Yii::$app->user->identity->username . '%"');
            }]);
            $query->andFilterWhere([
                'id' => $this->id,
                'fecha' => $this->fecha,
                'id_analista' => $this->id_analista,
            ])
                ->orderBy(['fecha' => SORT_DESC]);
        }

        $query->andFilterWhere(['like', 'descripcion', $this->descripcion]);

        return $dataProvider;
    }
    public function getUser()
    {
        return $this->hasOne(User::className(),['cedula' =>'id_analista']);
    }

    public function getNombreCompleto()
    {
        return $this->user? $this->user->nombre.' '.$this->user->apellido: 'Vacio';
    }
    public function getAnalista()
    {
        $datos = User::find()->andwhere(['rol_id' =>'3' ])->andwhere('user.supervisor LIKE "%' . Yii::$app->user->identity->username . '%"')->all();
        return ArrayHelper::map($datos, 'id', 'nombreCompleto');
    }
}
