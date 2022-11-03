<?php
require_once(__DIR__ . "/../3-Gestor/LocaisExtracaoGestorCest.php");
class LocaisExtracaoAdminCest extends LocaisExtracaoGestorCest
{
    public function _before(\FunctionalTester $I)
    {
        $I->amLoggedInAs(1);
        $I->amOnPage(['dashboard/locais-extracao']);
    }

    public function createTest(\FunctionalTester $I){
        $I->click('Novo Local de Extração');
        $I->fillField(["name"=>"LocalExtracao[nome]"], "Açores");
        $I->fillField(["name"=>"LocalExtracao[coordenadasGPS_X]"], 200.71);
        $I->fillField(["name"=>"LocalExtracao[coordenadasGPS_Y]"], -50.30);
        $I->click('Save');
        $I->seeRecord('app\models\LocalExtracao', ['and',["nome" => "Açores"],"coordenadasGPS_X LIKE 200.71", "coordenadasGPS_Y LIKE -50.3"]);
    }
}
