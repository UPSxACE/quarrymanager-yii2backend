<?php
require_once( __DIR__ . "/../3-Gestor/LojaGestorCest.php");
class LojaAdminCest extends LojaGestorCest
{
    public function _before(\FunctionalTester $I)
    {
        $I->amLoggedInAs(1);
        $I->amOnPage(['loja/']);
    }
}