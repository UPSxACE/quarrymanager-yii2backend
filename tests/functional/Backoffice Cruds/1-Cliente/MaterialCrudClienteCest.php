<?php
require_once( __DIR__ . "/../MaterialCest.php");
class MaterialCrudClienteCest extends MaterialCest
{
    public function _before(\FunctionalTester $I)
    {
        $I->amLoggedInAs(7);
        $I->amOnPage(['material/']);
    }

    public function indexTest(\FunctionalTester $I)
    {
        $I->see('Forbidden', 'h1');
    }
}