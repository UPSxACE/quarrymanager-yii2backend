<?php
require_once(__DIR__ . "/../2-Operario/LocaisArmazemOperarioCest.php");
class LocaisArmazemGestorCest extends LocaisArmazemOperarioCest
{
    public function _before(\FunctionalTester $I)
    {
        $I->amLoggedInAs(6);
        $I->amOnPage(['dashboard/locais-armazens']);
    }
}
