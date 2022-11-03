<?php
require_once( __DIR__ . "/../3-Gestor/FotografiaGestorCest.php");
class FotografiaAdminCest extends FotografiaGestorCest
{
    public function _before(\FunctionalTester $I)
    {
        $I->amLoggedInAs(1);
        $I->amOnPage(['fotografia/']);
    }

}