<?php

namespace app\modules\api\models;

use yii\httpclient\Client;

class FirebaseRest
{
    public static function notificarMensagem($destino_id, $pedido_titulo, $mensagem){
        $client = new Client();

        // Obter push token do usuário
        $push_token = $client->createRequest()
            ->setMethod("GET")
            ->setFormat(Client::FORMAT_JSON)
            ->setUrl("https://ds3-gestorapedreira-default-rtdb.europe-west1.firebasedatabase.app/users/user_". $destino_id ."/push_token.json")
            ->send();

        $push_token = $push_token->getData();

        // Enviar notificação
        $response = $client->createRequest()
            ->setMethod("POST")
            ->setFormat(Client::FORMAT_JSON)
            ->setUrl("https://exp.host/--/api/v2/push/send")
            ->setHeaders(["Accept" => "application/json", "Accept-encoding" => "gzip, deflate", "Content-Type" => "application/json"])
            ->setData([
                "to" => $push_token,
                "sound" => "default",
                "title" => $pedido_titulo,
                "body" => $mensagem,
            ])
            ->send();

        return $response->getData();
    }

    public static function notificarAtualizacaoPedido($id_pedido, $nome_estado, $nome_produto){
        $client = new Client();

        // Obter quem criou o pedido
        // Buscar dados desse novo canal
        $id_cliente = $client->createRequest()
            ->setMethod("GET")
            ->setFormat(Client::FORMAT_JSON)
            ->setUrl("https://ds3-gestorapedreira-default-rtdb.europe-west1.firebasedatabase.app/pedidos-clientes/".$id_pedido ."/cliente.json")
            ->send()
            ->getData();

        // Obter PushToken do Cliente
        $push_token = $client->createRequest()
            ->setMethod("GET")
            ->setFormat(Client::FORMAT_JSON)
            ->setUrl("https://ds3-gestorapedreira-default-rtdb.europe-west1.firebasedatabase.app/users/user_".$id_cliente ."/push_token.json")
            ->send()
            ->getData();

        // Enviar notificação de atualização de pedido
        $response = $client->createRequest()
            ->setMethod("POST")
            ->setFormat(Client::FORMAT_JSON)
            ->setUrl("https://exp.host/--/api/v2/push/send")
            ->setHeaders(["Accept" => "application/json", "Accept-encoding" => "gzip, deflate", "Content-Type" => "application/json"])
            ->setData([
                "to" => $push_token,
                "sound" => "default",
                "title" => $nome_produto . ": " . $nome_estado,
                "body" => "O estado do seu pedido foi atualizado",
            ])
            ->send();

        return $response->getData();
    }
}