<?php
require_once( __DIR__ . "/../DashboardCest.php");
class DashboardClienteCest extends DashboardCest
{
    public function _before(\FunctionalTester $I)
    {
        $I->amLoggedInAs(7);
        $I->amOnPage(['dashboard/home']);
    }

    public function indexTest(\FunctionalTester $I)
    {
        $I->see('Forbidden', 'h1');
    }
}
