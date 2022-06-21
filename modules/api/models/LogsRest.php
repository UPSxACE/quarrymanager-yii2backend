<?php

namespace app\modules\api\models;

use app\models\Logs;
use yii\data\ActiveDataProvider;

class LogsRest extends Logs
{
    public function fields(){
        return ['id', 'descricao','dataHora', 'idUser0', 'idTipoAcao0'];
    }

    public function dadosListar($params){
        $query = LogsRest::find();

        $dataProvider = new ActiveDataProvider([
            'query'=>$query,
            'pagination' => [
                'pageSize' => 7,
            ],

        ]);

        $this->load($params, "");

        if(isset($params["tipoAcao"])){
            $query->innerJoinWith('idTipoAcao0')->andFilterWhere([
                'tipoacao.id' => $params["tipoAcao"]
            ]);
        }

        return $dataProvider;
    }

    public function getIdTipoAcao0()
    {
        return $this->hasOne(TipoAcaoRest::className(), ['id' => 'idTipoAcao']);
    }

    public function getIdUser0()
    {
        return $this->hasOne(UserRest::className(), ['id' => 'idUser']);
    }
}