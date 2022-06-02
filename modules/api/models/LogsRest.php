<?php

namespace app\modules\api\models;

use app\models\Logs;
use yii\data\ActiveDataProvider;

class LogsRest extends Logs
{
    public function fields(){
        return ['descricao','dataHora', 'idUser0', 'idTipoAcao0'];
    }

    public function dadosListar($params){
        $query = LogsRest::find();

        $dataProvider = new ActiveDataProvider([
            'query'=>$query
        ]);

        $this->load($params, "");

        return $dataProvider;
    }

    public function getIdTipoAcao0()
    {
        return $this->hasOne(TipoAcaoRest::className(), ['id' => 'idTipoAcao']);
    }
}