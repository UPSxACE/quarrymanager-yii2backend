<?php
require_once(__DIR__ . "/../2-Operario/LocaisExtracaoOperarioCest.php");
class LocaisExtracaoGestorCest extends LocaisExtracaoOperarioCest
{
    public function _before(\FunctionalTester $I)
    {
        $I->amLoggedInAs(6);
        $I->amOnPage(['dashboard/locais-extracao']);
    }
}
