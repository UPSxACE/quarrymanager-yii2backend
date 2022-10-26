<?php
require_once( __DIR__ . "/../2-Operario/TransportadorasOperarioCest.php");
class TransportadorasGestorCest extends TransportadorasOperarioCest
{
    public function _before(\FunctionalTester $I)
    {
        $I->amLoggedInAs(6);
        $I->amOnPage(['dashboard/transportadoras']);
    }

    public function createTest(\FunctionalTester $I){
        $I->click('Nova Transportadora');
        $I->fillField(["name"=>"Transportadora[nome]"], "YYYYY Express");
        $I->click('Save');
        $I->seeRecord('app\models\Transportadora', ["nome" => "YYYYY Express"]);
    }
}
