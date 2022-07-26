<?php
require_once( __DIR__ . "/../LogsCest.php");
class LogsClienteCest extends LogsCest
{
    public function _before(\FunctionalTester $I)
    {
        $I->amLoggedInAs(7);
        $I->amOnPage(['logs/']);
    }

    public function indexTest(\FunctionalTester $I)
    {
        $I->see('Forbidden', 'h1');
    }

}
