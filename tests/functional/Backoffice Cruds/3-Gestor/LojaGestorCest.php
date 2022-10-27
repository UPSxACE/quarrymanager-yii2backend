<?php
require_once( __DIR__ . "/../2-Operario/LojaOperarioCest.php");
class LojaGestorCest extends LojaOperarioCest
{
    public function _before(\FunctionalTester $I)
    {
        $I->amLoggedInAs(6);
        $I->amOnPage(['loja/']);
    }
}