<?php
require_once( __DIR__ . "/../2-Operario/TipoAcaoOperarioCest.php");
class TipoAcaoGestorCest extends TipoAcaoOperarioCest
{
    public function _before(\FunctionalTester $I)
    {
        $I->amLoggedInAs(6);
        $I->amOnPage(['tipo-acao/']);
    }
}