<?php
require_once( __DIR__ . "/../2-Operario/LocalExtracaoOperarioCest.php");
class LocalArmazemGestorCest extends LocalArmazemOperarioCest
{
    public function _before(\FunctionalTester $I)
    {
        $I->amLoggedInAs(6);
        $I->amOnPage(['local-armazem/']);
    }
}