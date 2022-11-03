<?php
class ProfileCest
{
    public function _before(\FunctionalTester $I)
    {
        $I->amOnPage(['profile/']);
    }

    public function indexTest(\FunctionalTester $I)
    {
        $I->see('Login', 'h1');
    }
}