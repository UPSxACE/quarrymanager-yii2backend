<?php

class LojaDashboardGestorCest{
    public function _before(\FunctionalTester $I)
    {
        $I->amLoggedInAs(6);
        $I->amOnPage(['dashboard/loja']);
    }

    public function indexTest(\FunctionalTester $I)
    {
        $I->see('Loja', 'h1');
    }

}