<?php
require_once( __DIR__ . "/../3-Gestor/EncomendaGestorCest.php");
class EncomendaAdminCest extends EncomendaGestorCest
{
    public function _before(\FunctionalTester $I)
    {
        $I->amLoggedInAs(1);
        $I->amOnPage(['dashboard/encomendas/']);
    }

}
