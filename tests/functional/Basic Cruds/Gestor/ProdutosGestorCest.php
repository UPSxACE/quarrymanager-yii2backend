<?php
require_once( __DIR__ . "/../Operario/ProdutosOperarioCest.php");
class ProdutosGestorCest extends ProdutosOperarioCest
{
    public function _before(\FunctionalTester $I)
    {
        $I->amLoggedInAs(6);
        $I->amOnPage(['dashboard/produtos']);
    }

    public function indexTest(\FunctionalTester $I)
    {
        $I->see('Produtos', 'h1');
    }
}
