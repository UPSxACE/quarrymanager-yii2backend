<?php
require_once( __DIR__ . "/../3-Gestor/TipoAcaoGestorCest.php");
class TipoAcaoAdminCest extends TipoAcaoGestorCest
{
    public function _before(\FunctionalTester $I)
    {
        $I->amLoggedInAs(1);
        $I->amOnPage(['tipo-acao/']);
    }

}