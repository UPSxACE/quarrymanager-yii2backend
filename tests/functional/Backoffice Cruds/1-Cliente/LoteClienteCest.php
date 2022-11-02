<?php
require_once( __DIR__ . "/../LoteCest.php");
class LoteClienteCest extends LoteCest
{
    public function _before(\FunctionalTester $I)
    {
        $I->amLoggedInAs(7);
        $I->amOnPage(['lote/']);
    }

    public function indexTest(\FunctionalTester $I)
    {
        $I->see('Forbidden', 'h1');
    }
}
