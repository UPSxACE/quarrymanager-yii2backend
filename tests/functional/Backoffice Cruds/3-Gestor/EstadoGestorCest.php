<?php
require_once( __DIR__ . "/../2-Operario/EstadoOperarioCest.php");
class EstadoGestorCest extends EstadoOperarioCest
{
    public function _before(\FunctionalTester $I)
    {
        $I->amLoggedInAs(6);
        $I->amOnPage(['estado/']);
    }
}