<?php
// require_once( __DIR__ . "/../1-Cliente/ProdutosClienteCest.php");
class TransportadorasOperarioCest // extends ProdutosClienteCest
{
    public function _before(\FunctionalTester $I)
    {
        $I->amLoggedInAs(5);
        $I->amOnPage(['dashboard/transportadoras']);
    }
}
