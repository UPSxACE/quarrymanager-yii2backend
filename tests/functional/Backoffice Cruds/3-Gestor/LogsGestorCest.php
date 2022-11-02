<?php
require_once( __DIR__ . "/../2-Operario/LogsOperarioCest.php");
class LogsGestorCest extends LogsOperarioCest
{
    public function _before(\FunctionalTester $I)
    {
        $I->amLoggedInAs(6);
        $I->amOnPage(['logs/']);
    }
}