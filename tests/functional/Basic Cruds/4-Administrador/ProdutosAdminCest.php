<?php
require_once( __DIR__ . "/../3-Gestor/ProdutosGestorCest.php");
class ProdutosAdminCest extends ProdutosGestorCest
{
    public function _before(\FunctionalTester $I)
    {
        $I->amLoggedInAs(1);
        $I->amOnPage(['dashboard/produtos']);
    }
}
