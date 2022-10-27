<?php
require_once( __DIR__ . "/../1-Cliente/PerfilClienteCest.php");
class PerfilOperarioCest extends PerfilClienteCest
{
    public function _before(\FunctionalTester $I)
    {
        $I->amLoggedInAs(5);
        $I->amOnPage(['perfil/meu-perfil']);
    }
}