<?php
namespace Helper;

// here you can define custom actions
// all public methods declared in helper class will be available in $I

class ForceLoad extends \Codeception\Module
{
    public function createMaterial() {
        $material = $this->getModule('Yii2')->_request('POST', '/api/material/add', ["nome" => "Areia", "prefixo" => "ARE"]);
        $material = json_decode($material);
        //$this->getModule("Yii2")->_loadPage("GET", "/", ["Request Headers" => ["content-type" => "text/html; charset=utf-8"]]);
        return $material;
    }

    public function createCor() {
        $cor = $this->getModule('Yii2')->_request('POST', '/api/cor/add', ["nome" => "Preto", "prefixo" => "PRT"]);
        $cor = json_decode($cor);
        //$this->getModule("Yii2")->_loadPage("GET", "/", null, null, []);
        return $cor;
    }
}
