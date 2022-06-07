<?php

namespace app\modules\api\models;

use app\models\User;
use yii\data\ActiveDataProvider;

class UserRest extends User
{
    public function rules()
    {
        $rules = [
            [['role_id'], 'safe'],
        ];


        return $rules;
    }

    public static function tableName(){
        return 'user';
    }

    public function fields(){
        return ['username', 'profile', 'role'];
    }

    public function dadosListar($params){
        $query = UserRest::find();

        $dataProvider = new ActiveDataProvider([
            'query'=>$query,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        $this->load($params, "");

        $query->andFilterWhere([
            'role_id' => $this->role_id
        ]);

        return $dataProvider;
    }

    public function getProfile()
    {
        return $this->hasOne(ProfileRest::className(), ['user_id' => 'id']);
    }

    public function getRole()
    {
        return $this->hasOne(RoleRest::className(), ['id' => 'role_id']);
    }
}