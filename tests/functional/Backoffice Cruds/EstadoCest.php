<?php

class EstadoCest
{
    public function _before(\FunctionalTester $I)
    {
        $I->amOnPage(['estado/']);
    }

    public function indexTest(\FunctionalTester $I)
    {
        $I->see('Login', 'h1');
    }
}