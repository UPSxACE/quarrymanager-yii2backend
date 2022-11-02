<?php
require_once( __DIR__ . "/../EstadoCest.php");
class EstadoClienteCest extends EstadoCest
{
    public function _before(\FunctionalTester $I)
    {
        $I->amLoggedInAs(7);
        $I->amOnPage(['estado/']);
    }

    public function indexTest(\FunctionalTester $I)
    {
        $I->see('Forbidden', 'h1');
    }
}
