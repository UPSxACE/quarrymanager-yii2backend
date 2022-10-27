<?php
class PerfilDefinicoesCest
{
    public function _before(\FunctionalTester $I)
    {
        $I->amOnPage(['perfil/definicoes']);
    }

    public function indexTest(\FunctionalTester $I)
    {
        $I->see('Login', 'h1');
    }
}