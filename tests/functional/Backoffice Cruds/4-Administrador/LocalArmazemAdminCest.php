<?php
require_once(__DIR__ . "/../3-Gestor/LocalArmazemGestorCest.php");
class LocalArmazemAdminCest extends LocalArmazemGestorCest
{
    public function _before(\FunctionalTester $I)
    {
        $I->amLoggedInAs(1);
        $I->amOnPage(['local-armazem/']);
    }

}