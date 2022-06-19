<?php

namespace app\modules\api\models;

use app\models\Fotografia;
use app\models\Profile;

class ProfileRest extends Profile
{
    public function fields(){
        return ['full_name', 'created_at', 'genero', 'morada', 'dataNascimento', 'localidade', 'codPostal', 'telefone', 'email','profilePic'=> function ($model) {$picUrl = Fotografia::findOne($model->idFotografia); return $picUrl->link;}];
    }

    public function extraFields()
    {
        return ['username'=> function ($model) {return $model->user->username;}];
    }
}