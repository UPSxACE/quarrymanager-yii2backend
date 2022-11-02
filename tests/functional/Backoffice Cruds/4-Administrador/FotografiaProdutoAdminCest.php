<?php
require_once( __DIR__ . "/../3-Gestor/FotografiaProdutoGestorCest.php");
class FotografiaProdutoAdminCest extends FotografiaProdutoGestorCest
{
    public function _before(\FunctionalTester $I)
    {
        $I->amLoggedInAs(1);
        $I->amOnPage(['fotografia-produto/']);
    }

}
