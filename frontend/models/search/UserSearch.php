<?php

namespace frontend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\User;

/**
 * UserSearch represents the model behind the search form about `frontend\models\User`.
 */
class UserSearch extends User
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status', 'created_at', 'updated_at', 'rol_id', 'id_organizacion', 'id_distrito','id_empresa','id_division','id_aplicacion'], 'integer'],
            [['username', 'auth_key', 'password_hash', 'password_reset_token', 'email', 'nombre', 'apellido', 'cedula','supervisor'], 'safe'],
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
        $query = User::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        if(Yii::$app->user->identity->rol_id=='2'){
            $query->andFilterWhere([
                'id' => $this->id,
                'status' => 10,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
                'rol_id' => $this->rol_id,
                'supervisor' => $this->supervisor,
                'id_organizacion' => $this->id_organizacion,
                'id_empresa' => $this->id_empresa,
                'id_distrito' => $this->id_distrito,
            ])
                ->orderBy(['username' => SORT_ASC]);
        }
        else{
            $query->andFilterWhere([
                'id' => $this->id,
                'status' => 10,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
                'rol_id' => '1',
                'supervisor' => $this->supervisor,
                'id_organizacion' => $this->id_organizacion,
                'id_empresa' => $this->id_empresa,
                'id_distrito' => $this->id_distrito,
                'id_division' => $this->id_division,
                'id_aplicacion' => $this->id_aplicacion,
            ])
                ->orderBy(['username' => SORT_ASC]);
        }

        $query->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'auth_key', $this->auth_key])
            ->andFilterWhere(['like', 'password_hash', $this->password_hash])
            ->andFilterWhere(['like', 'password_reset_token', $this->password_reset_token])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'nombre', $this->nombre])
            ->andFilterWhere(['like', 'apellido', $this->apellido])
            ->andFilterWhere(['like', 'cedula', $this->cedula]);


        return $dataProvider;
    }

}
