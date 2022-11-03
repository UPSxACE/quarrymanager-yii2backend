<?php
require_once( __DIR__ . "/../2-Operario/TransportadoraOperarioCest.php");
class TransportadoraGestorCest extends TransportadoraOperarioCest
{
    public function _before(\FunctionalTester $I)
    {
        $I->amLoggedInAs(6);
        $I->amOnPage(['transportadora/']);
    }
}