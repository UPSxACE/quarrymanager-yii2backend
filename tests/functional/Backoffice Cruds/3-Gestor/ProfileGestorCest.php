<?php
require_once( __DIR__ . "/../2-Operario/ProfileOperarioCest.php");
class ProfileGestorCest extends ProfileOperarioCest
{
    public function _before(\FunctionalTester $I)
    {
        $I->amLoggedInAs(6);
        $I->amOnPage(['profile/']);
    }
}