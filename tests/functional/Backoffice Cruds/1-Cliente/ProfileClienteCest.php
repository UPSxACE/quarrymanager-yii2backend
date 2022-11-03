<?php
require_once( __DIR__ . "/../ProfileCest.php");
class ProfileClienteCest extends ProfileCest
{
    public function _before(\FunctionalTester $I)
    {
        $I->amLoggedInAs(7);
        $I->amOnPage(['profile/']);
    }

    public function indexTest(\FunctionalTester $I)
    {
        $I->see('Forbidden', 'h1');
    }
}