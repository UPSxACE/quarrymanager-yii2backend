<?php
require_once( __DIR__ . "/../3-Gestor/LogsGestorCest.php");
class LogsAdminCest extends LogsGestorCest
{
    public function _before(\FunctionalTester $I)
    {
        $I->amLoggedInAs(1);
        $I->amOnPage(['logs/']);
    }
}