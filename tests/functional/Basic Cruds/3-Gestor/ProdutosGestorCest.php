<?php
require_once( __DIR__ . "/../2-Operario/ProdutosOperarioCest.php");
class ProdutosGestorCest extends ProdutosOperarioCest
{
    public function _before(\FunctionalTester $I)
    {
        $I->amLoggedInAs(6);
        $I->amOnPage(['dashboard/produtos']);
    }
}
