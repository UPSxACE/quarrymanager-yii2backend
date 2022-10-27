<?php

use yii\filters\AccessControl;
use yii\filters\VerbFilter;

require_once( __DIR__ . "/../PerfilDefinicoesCest.php");
class PerfilDefinicoesGestorCest extends PerfilDefinicoesCest
{

    public function _before(\FunctionalTester $I)
    {
        $I->amLoggedInAs(6);
        $I->amOnPage(['perfil/definicoes']);
    }
    public function indexTest(\FunctionalTester $I)
    {
        $I->see('Definições da Conta', 'h1');
    }
    public function updatePerfilConfigTest(\FunctionalTester $I)
    {
        $I->fillField(["name"=>'User[username]'],"Gestor");
        $I->fillField(["name"=>'User[currentPassword]'],"gestor");
        $I->fillField(["name"=>'User[newPassword]'],"gestor123");
        $I->fillField(["name"=>'User[newPasswordConfirm]'],"gestor123");
        $I->click('Save', 'button');
        $I->see('Definições da conta atualizados com sucesso.');
    }
}