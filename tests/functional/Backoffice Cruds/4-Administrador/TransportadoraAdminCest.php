<?php
require_once( __DIR__ . "/../3-Gestor/TransportadoraGestorCest.php");
class TransportadoraAdminCest extends TransportadoraGestorCest
{
    public function _before(\FunctionalTester $I)
    {
        $I->amLoggedInAs(1);
        $I->amOnPage(['transportadora/']);
    }

}