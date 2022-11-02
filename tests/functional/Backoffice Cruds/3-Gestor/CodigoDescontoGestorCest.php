<?php
require_once( __DIR__ . "/../2-Operario/CodigoDescontoOperarioCest.php");
class CodigoDescontoGestorCest extends CodigoDescontoOperarioCest
{
    public function _before(\FunctionalTester $I)
    {
        $I->amLoggedInAs(6);
        $I->amOnPage(['codigo-desconto/']);
    }
}