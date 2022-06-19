<?php

namespace app\modules\api\models;

use app\models\Profile;

class ProfileRest extends Profile
{
    public function fields(){
        return ['full_name', 'created_at', 'genero', 'morada', 'dataNascimento', 'localidade', 'codPostal', 'telefone', 'email'];
    }

    public function extraFields()
    {
        return ['username'=> function ($model) {return $model->user->username;}];
    }
}