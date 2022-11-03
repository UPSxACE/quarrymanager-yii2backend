<?php
require_once( __DIR__ . "/../3-Gestor/ProdutoGestorCest.php");
class ProdutoAdminCest extends ProdutoGestorCest
{
    public function _before(\FunctionalTester $I)
    {
        $I->amLoggedInAs(1);
        $I->amOnPage(['produto/']);
    }

}