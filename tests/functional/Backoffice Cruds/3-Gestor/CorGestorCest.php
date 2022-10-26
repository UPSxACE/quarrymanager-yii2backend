<?php
require_once( __DIR__ . "/../2-Operario/CorOperarioCest.php");
class CorGestorCest extends CorOperarioCest
{
    public function _before(\FunctionalTester $I)
    {
        $I->amLoggedInAs(6);
        $I->amOnPage(['cor/']);
    }
}