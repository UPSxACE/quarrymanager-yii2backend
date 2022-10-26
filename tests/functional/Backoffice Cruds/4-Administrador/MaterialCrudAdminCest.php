<?php
require_once( __DIR__ . "/../3-Gestor/MaterialCrudGestorCest.php");
class MaterialCrudAdminCest extends MaterialCrudGestorCest
{
    public function _before(\FunctionalTester $I)
    {
        $I->amLoggedInAs(1);
        $I->amOnPage(['material/']);
    }

}
