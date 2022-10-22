<?php
require_once( __DIR__ . "/../ProdutosCest.php");
class ProdutosOperarioCest extends ProdutosCest
{
    public function _before(\FunctionalTester $I)
    {
        $I->amLoggedInAs(5);
        $I->amOnPage(['dashboard/produtos']);
    }
}
