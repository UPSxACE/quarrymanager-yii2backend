<?php
require_once( __DIR__ . "/../FotografiaLoteCest.php");
class FotografiaLoteClienteCest extends FotografiaLoteCest
{
    public function _before(\FunctionalTester $I)
    {
        $I->amLoggedInAs(7);
        $I->amOnPage(['fotografia-lote/']);
    }

    public function indexTest(\FunctionalTester $I)
    {
        $I->see('Forbidden', 'h1');
    }
}
