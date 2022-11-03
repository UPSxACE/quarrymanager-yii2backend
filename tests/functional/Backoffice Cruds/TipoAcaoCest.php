<?php
class TipoAcaoCest
{
    public function _before(\FunctionalTester $I)
    {
        $I->amOnPage(['tipo-acao/']);
    }

    public function indexTest(\FunctionalTester $I)
    {
        $I->see('Login', 'h1');
    }
}