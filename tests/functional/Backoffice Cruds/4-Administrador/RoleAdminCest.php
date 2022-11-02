<?php
require_once( __DIR__ . "/../3-Gestor/RoleGestorCest.php");
class RoleAdminCest extends RoleGestorCest
{
    public function _before(\FunctionalTester $I)
    {
        $I->amLoggedInAs(1);
        $I->amOnPage(['role/']);
    }

}
