<?php
require_once( __DIR__ . "/../3-Gestor/PerfilGestorCest.php");
class PerfilAdministradorCest extends PerfilGestorCest
{
    public function _before(\FunctionalTester $I)
    {
        $I->amLoggedInAs(1);
        $I->amOnPage(['perfil/meu-perfil']);
    }
}