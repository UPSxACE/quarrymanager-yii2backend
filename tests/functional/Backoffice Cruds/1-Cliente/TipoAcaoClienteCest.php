<?php
require_once( __DIR__ . "/../TipoAcaoCest.php");
class TipoAcaoClienteCest extends TipoAcaoCest
{
    public function _before(\FunctionalTester $I)
    {
        $I->amLoggedInAs(7);
        $I->amOnPage(['tipo-acao/']);
    }

    public function indexTest(\FunctionalTester $I)
    {
        $I->see('Forbidden', 'h1');
    }
}