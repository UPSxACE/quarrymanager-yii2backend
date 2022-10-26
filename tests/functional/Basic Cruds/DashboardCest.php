<?php
class DashboardCest
{
    public function _before(\FunctionalTester $I)
    {
        $I->amOnPage(['dashboard/home']);
    }

    public function indexTest(\FunctionalTester $I)
    {
        $I->see('Login', 'h1');
    }
}
