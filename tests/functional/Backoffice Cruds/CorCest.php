<?php
    class CorCest
{
    public function _before(\FunctionalTester $I)
    {
        $I->amOnPage(['cor/']);
    }

    public function indexTest(\FunctionalTester $I)
    {
        $I->see('Login', 'h1');
    }
}
