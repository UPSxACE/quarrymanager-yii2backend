<?php
class RoleCest
{
    public function _before(\FunctionalTester $I)
    {
        $I->amOnPage(['role/']);
    }

    public function indexTest(\FunctionalTester $I)
    {
        $I->see('Login', 'h1');
    }
}