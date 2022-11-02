<?php
require_once( __DIR__ . "/../3-Gestor/FotografiaLoteGestorCest.php");
class FotografiaLoteAdminCest extends FotografiaLoteGestorCest
{
    public function _before(\FunctionalTester $I)
    {
        $I->amLoggedInAs(1);
        $I->amOnPage(['fotografia-lote/']);
    }

}
