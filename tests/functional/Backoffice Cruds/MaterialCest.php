<?php
   class MaterialCest
{
    public function _before(\FunctionalTester $I)
    {
        $I->amOnPage(['material/']);
    }

    public function indexTest(\FunctionalTester $I)
    {
        $I->see('Login', 'h1');
    }
}