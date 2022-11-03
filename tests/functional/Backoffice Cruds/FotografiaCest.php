<?php
class FotografiaCest
{
    public function _before(\FunctionalTester $I)
    {
        $I->amOnPage(['fotografia/']);
    }

    public function indexTest(\FunctionalTester $I)
    {
        $I->see('Login', 'h1');
    }
}