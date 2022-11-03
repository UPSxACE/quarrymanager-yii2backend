<?php
require_once( __DIR__ . "/../3-Gestor/LoteGestorCest.php");
class LoteAdminCest extends LoteGestorCest
{
    public function _before(\FunctionalTester $I)
    {
        $I->amLoggedInAs(1);
        $I->amOnPage(['lote/']);
    }

}