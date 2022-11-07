<?php

class StockOperarioCest
{
    public function _before(\FunctionalTester $I)
    {
        $I->amLoggedInAs(5);
        $I->amOnPage(['dashboard/stock']);
    }

    public function indexTest(\FunctionalTester $I)
    {
        $I->see('Stock', 'h1');
    }
}
