<?php
require_once( __DIR__ . "/../3-Gestor/EstadoGestorCest.php");
class EstadoAdminCest extends EstadoGestorCest
{
    public function _before(\FunctionalTester $I)
    {
        $I->amLoggedInAs(1);
        $I->amOnPage(['estado/']);
    }

}