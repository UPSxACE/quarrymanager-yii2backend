<?php
require_once( __DIR__ . "/../1-Cliente/LogsClienteCest.php");
class LogsOperarioCest extends LogsClienteCest
{
    public function _before(\FunctionalTester $I)
    {
        $I->amLoggedInAs(5);
        $I->amOnPage(['logs/']);
    }
}