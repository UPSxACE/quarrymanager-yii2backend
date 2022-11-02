<?php
require_once( __DIR__ . "/../2-Operario/LoteOperarioCest.php");
class LoteGestorCest extends LoteOperarioCest
{
    public function _before(\FunctionalTester $I)
    {
        $I->amLoggedInAs(6);
        $I->amOnPage(['lote/']);
    }
}