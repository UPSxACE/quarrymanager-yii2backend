<?php
require_once( __DIR__ . "/../LocalArmazemCest.php");
class LocalArmazemClienteCest extends LocalArmazemCest
{
    public function _before(\FunctionalTester $I)
    {
        $I->amLoggedInAs(7);
        $I->amOnPage(['local-armazem/']);
    }

    public function indexTest(\FunctionalTester $I)
    {
        $I->see('Forbidden', 'h1');
    }
}