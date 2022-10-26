<?php
require_once( __DIR__ . "/../3-Gestor/CorGestorCest.php");
class CorAdminCest extends CorGestorCest
{
    public function _before(\FunctionalTester $I)
    {
        $I->amLoggedInAs(1);
        $I->amOnPage(['cor/']);
    }

}
