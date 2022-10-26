<?php
require_once( __DIR__ . "/../2-Operario/MaterialCrudOperarioCest.php");
class MaterialCrudGestorCest extends MaterialCrudOperarioCest
{
    public function _before(\FunctionalTester $I)
    {
        $I->amLoggedInAs(6);
        $I->amOnPage(['material/']);
    }
}