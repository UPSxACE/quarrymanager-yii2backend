<?php
require_once( __DIR__ . "/../TransportadoraCest.php");
class TransportadoraClienteCest extends TransportadoraCest
{
    public function _before(\FunctionalTester $I)
    {
        $I->amLoggedInAs(7);
        $I->amOnPage(['transportadora/']);
    }

    public function indexTest(\FunctionalTester $I)
    {
        $I->see('Forbidden', 'h1');
    }
}
