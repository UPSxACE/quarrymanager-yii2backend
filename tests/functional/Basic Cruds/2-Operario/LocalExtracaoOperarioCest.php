<?php
// require_once( __DIR__ . "/../1-Cliente/ProdutosClienteCest.php");
class LocalExtracaoOperarioCest // extends ProdutosClienteCest
{
    public function _before(\FunctionalTester $I)
    {
        $I->amLoggedInAs(5);
        $I->amOnPage(['dashboard/locais-extracao']);
    }
}
