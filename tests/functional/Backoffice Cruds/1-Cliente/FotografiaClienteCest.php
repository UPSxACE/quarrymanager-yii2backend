<?php
require_once( __DIR__ . "/../FotografiaCest.php");
class FotografiaClienteCest extends FotografiaCest
{
    public function _before(\FunctionalTester $I)
    {
        $I->amLoggedInAs(7);
        $I->amOnPage(['fotografia/']);
    }

    public function indexTest(\FunctionalTester $I)
    {
        $I->see('Forbidden', 'h1');
    }
}