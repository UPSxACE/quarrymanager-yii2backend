<?php
require_once( __DIR__ . "/../2-Operario/FotografiaLoteOperarioCest.php");
class FotografiaGestorCest extends FotografiaOperarioCest
{
    public function _before(\FunctionalTester $I)
    {
        $I->amLoggedInAs(6);
        $I->amOnPage(['fotografia/']);
    }
}