<?php

class TransportadoraCest
{
    public function _before(\FunctionalTester $I)
    {
        $I->amOnPage(['transportadora/']);
    }

    public function indexTest(\FunctionalTester $I)
    {
        $I->see('Login', 'h1');
    }
}