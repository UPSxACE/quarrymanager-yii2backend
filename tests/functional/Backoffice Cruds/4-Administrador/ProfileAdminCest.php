<?php
require_once( __DIR__ . "/../3-Gestor/ProfileGestorCest.php");
class ProfileAdminCest extends ProfileGestorCest
{
    public function _before(\FunctionalTester $I)
    {
        $I->amLoggedInAs(1);
        $I->amOnPage(['profile/']);
    }

}
