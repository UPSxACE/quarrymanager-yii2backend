<?php

class LogsDashboardGestorCest{
    public function _before(\FunctionalTester $I)
    {
        $I->amLoggedInAs(6);
        $I->amOnPage(['dashboard/logs']);
    }

    public function indexTest(\FunctionalTester $I)
    {
        $I->see('Logs', 'h1');
    }

}