<?php
require_once( __DIR__ . "/../2-Operario/RoleOperarioCest.php");
class RoleGestorCest extends RoleOperarioCest
{
    public function _before(\FunctionalTester $I)
    {
        $I->amLoggedInAs(6);
        $I->amOnPage(['role/']);
    }
}