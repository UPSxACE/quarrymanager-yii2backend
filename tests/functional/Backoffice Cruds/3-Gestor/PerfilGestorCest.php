<?php
require_once( __DIR__ . "/../2-Operario/PerfilOperarioCest.php");
class PerfilGestorCest extends PerfilOperarioCest
{
    public function _before(\FunctionalTester $I)
    {
        $I->amLoggedInAs(6);
        $I->amOnPage(['perfil/meu-perfil']);
    }
}