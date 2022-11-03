<?php
class LocalArmazemCest
{
    public function _before(\FunctionalTester $I)
    {
        $I->amOnPage(['local-armazem/']);
    }

    public function indexTest(\FunctionalTester $I)
    {
        $I->see('Login', 'h1');
    }
}