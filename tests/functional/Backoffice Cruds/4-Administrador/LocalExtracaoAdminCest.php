<?php
require_once(__DIR__ . "/../3-Gestor/LocalExtracaoGestorCest.php");
class LocalExtracaoAdminCest extends LocalExtracaoGestorCest
{
    public function _before(\FunctionalTester $I)
    {
        $I->amLoggedInAs(1);
        $I->amOnPage(['local-extracao/']);
    }

}