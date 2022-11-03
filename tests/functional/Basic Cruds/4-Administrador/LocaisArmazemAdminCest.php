<?php
require_once(__DIR__ . "/../3-Gestor/LocaisArmazemGestorCest.php");
class LocaisArmazemAdminCest extends LocaisArmazemGestorCest
{
    public function _before(\FunctionalTester $I)
    {
        $I->amLoggedInAs(1);
        $I->amOnPage(['dashboard/locais-armazens']);
    }

    public function createTest(\FunctionalTester $I){
        $I->click('Novo Local de Armazém');
        $I->fillField(["name"=>"LocalArmazem[nome]"], "Açores");
        $I->click('Save');
        $I->seeRecord('app\models\LocalArmazem', ["nome" => "Açores"]);
    }
}
