<?php

namespace app\modules\api\models;

use app\models\Role;
use yii\data\ActiveDataProvider;

class RoleRest extends Role
{
    public function fields(){
        return ['name'];
    }

    public function dadosListar($params){
        $query = RoleRest::find();

        $dataProvider = new ActiveDataProvider([
            'query'=>$query
        ]);

        $this->load($params, "");

        return $dataProvider;
    }
}