<?php
require_once( __DIR__ . "/../1-Cliente/LojaClienteCest.php");
class LojaOperarioCest extends LojaClienteCest
{
    public function _before(\FunctionalTester $I)
    {
        $I->amLoggedInAs(5);
        $I->amOnPage(['loja/']);
    }
}