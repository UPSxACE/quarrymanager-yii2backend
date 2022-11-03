<?php
require_once( __DIR__ . "/../2-Operario/ProdutoOperarioCest.php");
class ProdutoGestorCest extends ProdutoOperarioCest
{
    public function _before(\FunctionalTester $I)
    {
        $I->amLoggedInAs(6);
        $I->amOnPage(['produto/']);
    }
}