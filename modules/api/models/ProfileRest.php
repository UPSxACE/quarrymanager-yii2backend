<?php

namespace app\modules\api\models;

use app\models\Profile;

class ProfileRest extends Profile
{
    public function extraFields(){
        //return ['idUser0'];
    }
}