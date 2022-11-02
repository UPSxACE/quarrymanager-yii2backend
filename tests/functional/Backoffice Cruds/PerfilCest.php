<?php
class PerfilCest
{
    public function _before(\FunctionalTester $I)
    {
        $I->amOnPage(['perfil/meu-perfil']);
    }

    public function indexTest(\FunctionalTester $I)
    {
        $I->see('Login', 'h1');
    }
}