<?php
require_once( __DIR__ . "/../LocalExtracaoCest.php");
class LocalExtracaoClienteCest extends LocalExtracaoCest
{
    public function _before(\FunctionalTester $I)
    {
        $I->amLoggedInAs(7);
        $I->amOnPage(['local-extracao/']);
    }

    public function indexTest(\FunctionalTester $I)
    {
        $I->see('Forbidden', 'h1');
    }
}