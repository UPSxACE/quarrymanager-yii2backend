<?php
require_once( __DIR__ . "/../2-Operario/LocalExtracaoOperarioCest.php");
class LocalExtracaoGestorCest extends LocalExtracaoOperarioCest
{
    public function _before(\FunctionalTester $I)
    {
        $I->amLoggedInAs(6);
        $I->amOnPage(['dashboard/locais-extracao']);
    }
}
