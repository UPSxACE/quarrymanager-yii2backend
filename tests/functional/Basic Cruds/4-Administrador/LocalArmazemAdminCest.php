<?php
require_once( __DIR__ . "/../3-Gestor/LocalArmazemGestorCest.php");
class LocalArmazemAdminCest extends LocalArmazemGestorCest
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
