<?php
require_once( __DIR__ . "/../Cliente/ProdutosClienteCest.php");
class ProdutosOperarioCest extends ProdutosClienteCest
{
    public function _before(\FunctionalTester $I)
    {
        $I->amLoggedInAs(5);
        $I->amOnPage(['dashboard/produtos']);
    }

    public function indexTest(\FunctionalTester $I)
    {
        $I->see('Produtos', 'h1');
    }
}
