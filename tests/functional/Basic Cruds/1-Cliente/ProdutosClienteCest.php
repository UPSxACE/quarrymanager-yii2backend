<?php
require_once( __DIR__ . "/../ProdutosCest.php");
class ProdutosClienteCest extends ProdutosCest
{
    public function _before(\FunctionalTester $I)
    {
        $I->amLoggedInAs(7);
        $I->amOnPage(['dashboard/produtos']);
    }

    public function indexTest(\FunctionalTester $I)
    {
        $I->see('Forbidden', 'h1');
    }
}
