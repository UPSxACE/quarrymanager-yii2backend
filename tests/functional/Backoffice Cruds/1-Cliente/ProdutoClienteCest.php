<?php
require_once( __DIR__ . "/../ProdutoCest.php");
class ProdutoClienteCest extends ProdutoCest
{
    public function _before(\FunctionalTester $I)
    {
        $I->amLoggedInAs(7);
        $I->amOnPage(['produto/']);
    }

    public function indexTest(\FunctionalTester $I)
    {
        $I->see('Forbidden', 'h1');
    }
}