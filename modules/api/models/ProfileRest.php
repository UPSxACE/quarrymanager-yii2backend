<?php

namespace app\modules\api\models;

use app\models\Profile;

class ProfileRest extends Profile
{
    public function fields(){
        return ['full_name', 'created_at'];
    }
}